<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Logger;
use App\Models\Message;
use App\Models\Response;
use Illuminate\Support\Facades\Http;
use App\Models\Training;
use App\Models\User;
use App\Utils\Utilities;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function create()
    {
        return view('chats.create');
    }

    public function index()
    {
        $user = auth()->user();
        $users = collect();

        if (in_array($user->role_id, [1, 2])) {
            // Admin: All users
            $users = User::whereNotIn('id', [1, 2])
                ->with(['program', 'chats' => function ($query) {
                    $query->latest();
                }])->get();
        } elseif ($user->role_id === 3) {
            // Trainer: Users in same program
            $users = User::where('program_id', $user->program_id)
                ->with(['program', 'chats' => function ($query) {
                    $query->latest();
                }])
                ->get();
        } else {
            // Regular user: Only themselves
            $users = User::where('id', $user->id)
                ->with(['program', 'chats' => function ($query) {
                    $query->latest();
                }])
                ->get();
        }

        return view('chats.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'chat_id' => 'nullable|exists:chats,id'
        ]);

        $user = auth()->user();

        $programId = $user->program_id;

        if ($request->chat_id) {
            $chat = Chat::find($request->chat_id);
        } else {
            $chat = Chat::create([
                'user_id' => $user->id,
                'name' => now()->format('d-m-Y'),
            ]);
        }

        $message = Message::create([
            'chat_id' => $chat->id,
            'content' => $request->content,
        ]);

        // 1) Extraer keywords del prompt usando Utilities
        $rawKeywords = Utilities::getKeywords($request->content);

        // 2) Normalizar keywords como en TrainingController para mejorar el match
        $normalizedKeywords = collect($rawKeywords)
            ->filter(fn($kw) => is_string($kw))
            ->map(function ($kw) {
                $kw = Str::ascii($kw);
                $kw = mb_strtolower($kw);
                $kw = preg_replace('/[^\p{L}\p{N}\s\-]/u', ' ', $kw);
                $kw = trim(preg_replace('/\s+/', ' ', $kw));
                return $kw;
            })
            ->filter(fn($kw) => strlen($kw) >= 2)
            ->unique()
            ->values()
            ->all();
        // 3) Buscar el Training con más keywords coincidentes dentro del mismo programa
        $userIds = User::where('program_id', $programId)->pluck('id');
        $adminUserIds = User::whereIn('role_id', [1, 2])->pluck('id');
        $trainings = Training::whereIn('user_id', $userIds)
            ->orWhereIn('user_id', $adminUserIds)
            ->get();

        // Calcular coincidencias
        $bestTraining = null;
        $bestScore = 0;
        if (!empty($normalizedKeywords)) {
            foreach ($trainings as $trainingItem) {
                $trainingKeywords = is_array($trainingItem->keywords) ? $trainingItem->keywords : [];
                if (empty($trainingKeywords)) continue;
                // normalizar por si hay datos antiguos sin normalizar totalmente
                $trainingKeywordsNorm = collect($trainingKeywords)
                    ->filter(fn($kw) => is_string($kw))
                    ->map(function ($kw) {
                        $kw = Str::ascii($kw);
                        $kw = mb_strtolower($kw);
                        $kw = preg_replace('/[^\p{L}\p{N}\s\-]/u', ' ', $kw);
                        $kw = trim(preg_replace('/\s+/', ' ', $kw));
                        return $kw;
                    })
                    ->filter(fn($kw) => strlen($kw) >= 2)
                    ->unique()
                    ->values()
                    ->all();

                $score = count(array_intersect($normalizedKeywords, $trainingKeywordsNorm));
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestTraining = $trainingItem;
                }
            }
        }

        $responsePayload = [];
        if ($bestTraining && $bestScore > 0 && $bestTraining->file_path) {
            // Coincidió con un training: devolvemos el archivo directamente
            $responseContent = $bestTraining->file_path; // se guarda el file_path crudo
            $responseType = $bestTraining->type === 'schedule' ? 'image' : 'pdf';
            Response::create([
                'message_id' => $message->id,
                'content' => $responseContent,
                'type' => $responseType,
            ]);
            $responsePayload = [
                'chat_id' => $chat->id,
                'type' => $responseType,
                'content' => $responseContent,
                'matched_keywords' => $bestScore,
                'source_training_id' => $bestTraining->id,
            ];
        } else {
            // Flujo actual: generar respuesta de texto con Gemini
            $aiResponse = $this->getAIResponse($request->content, $programId);
            Response::create([
                'message_id' => $message->id,
                'content' => $aiResponse,
                'type' => 'text',
            ]);
            $responsePayload = [
                'chat_id' => $chat->id,
                'type' => 'text',
                'content' => $aiResponse,
            ];
        }
        // dd($responsePayload);
        return response()->json($responsePayload);
    }

    private function getAIResponse($prompt, $programId)
    {
        $apiKey = env('DEEPSEEK_API_KEY');

        $userIds = User::where('program_id', $programId)->pluck('id');
        $learnFields = Training::whereIn('user_id', $userIds)
            ->orWhereIn('user_id', User::whereIn('role_id', [1, 2])->pluck('id'))
            ->pluck('learn');

        $context = "Eres Unellez AI, un asistente virtual amigable y respetuoso. Tu tarea es responder
        preguntas únicamente usando la información proporcionada a continuación, que corresponde al contexto
        asignado del usuario. No inventes datos, no respondas fuera de este contexto y agrupa información
        repetida para dar una explicación clara y completa. Si no encuentras la respuesta en la información dada,
        indícalo amablemente.

        Contexto de referencia:
        " . $learnFields->implode("\n") . "

        Pregunta del usuario:
        " . $prompt;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post("https://api.deepseek.com/chat/completions", [
            'model' => 'deepseek-chat',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $context
                ]
            ]
        ]);

        Log::info('DeepSeek API Response: ' . $response->body());

        $responseData = $response->json();

        Logger::create([
            'content' => $responseData,
            'code' => $response->status(),
        ]);

        return $responseData['choices'][0]['message']['content'] ?? 'Lo siento, no pude generar una respuesta.';
    }

    public function show(Chat $chat)
    {
        $user = auth()->user();

        // Load chat owner to check program_id if needed
        $chatOwner = $chat->user;

        $isOwner = $chat->user_id === $user->id;
        $isAdmin = in_array($user->role_id, [1, 2]);
        $isTrainer = $user->role_id === 3 && $chatOwner->program_id === $user->program_id;

        if (!$isOwner && !$isAdmin && !$isTrainer) {
            abort(403, 'No tienes permiso para acceder a este chat');
        }

        $chat->load(['messages' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }, 'messages.response']);

        return view('chats.show', compact('chat'));
    }
}
