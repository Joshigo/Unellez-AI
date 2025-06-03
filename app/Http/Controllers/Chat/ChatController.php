<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Response;
use Illuminate\Support\Facades\Http;
use App\Models\Training;
use App\Models\User;

class ChatController extends Controller
{
    public function create()
    {
        return view('chats.create');
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

        $aiResponse = $this->getGeminiResponse($request->content, $programId);

        Response::create([
            'message_id' => $message->id,
            'content' => $aiResponse,
        ]);

        return response()->json([
            'chat_id' => $chat->id,
            'ai_response' => $aiResponse
        ]);
    }

    private function getGeminiResponse($prompt, $programId)
    {
        $apiKey = env('GEMINI_API_KEY');

        $userIds = User::where('program_id', $programId)->pluck('id');
        $learnFields = Training::whereIn('user_id', $userIds)->pluck('learn');

        $context = "Responde en base a esta información, no te salgas de contexto:\n" . $learnFields->implode("\n") . "\n\nPregunta del usuario: " . $prompt;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $context]
                    ]
                ]
            ]
        ]);

        $responseData = $response->json();

        return $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Lo siento, no pude generar una respuesta.';
    }

    public function show(Chat $chat)
    {
        if ($chat->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para acceder a este chat');
        }

        $chat->load(['messages' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }, 'messages.response']);

        return view('chats.show', compact('chat'));
    }
}
