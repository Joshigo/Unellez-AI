<?php

namespace App\Http\Controllers\Kpi;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Response;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KpiController extends Controller
{
    public function getKpisUser($userId)
    {
        // ... (existente)
    }

    public function getCoordinatorKpis()
    {
        // 1. Chats por programa (Histórico)
        $countChatsByPrograms = Chat::join('users', 'chats.user_id', '=', 'users.id')
            ->join('programs', 'users.program_id', '=', 'programs.id')
            ->select('users.program_id', 'programs.name as program_name', DB::raw('count(chats.id) as quantity'))
            ->groupBy('users.program_id', 'programs.name')
            ->get();

        // 2. Chats de HOY
        $chatsTodayByProgram = Chat::whereDate('chats.created_at', Carbon::today())
            ->join('users', 'chats.user_id', '=', 'users.id')
            ->join('programs', 'users.program_id', '=', 'programs.id')
            ->select('users.program_id', 'programs.name as program_name', DB::raw('count(chats.id) as quantity'))
            ->groupBy('users.program_id', 'programs.name')
            ->get();

        // Mensajes en chats creados HOY
        $messagesInChatsTodayCount = Chat::whereDate('created_at', Carbon::today())
            ->withCount('messages')
            ->get()
            ->sum('messages_count');

        // 3. Usuarios (role_id=4) por programa
        $usersRole4ByProgram = User::where('role_id', 4)
            ->join('programs', 'users.program_id', '=', 'programs.id')
            ->select('users.program_id', 'programs.name as program_name', DB::raw('count(users.id) as quantity'))
            ->groupBy('users.program_id', 'programs.name')
            ->get();

        return [
            'countChatsByPrograms' => $countChatsByPrograms,
            'chatsTodayByProgram' => $chatsTodayByProgram,
            'messagesInChatsTodayCount' => $messagesInChatsTodayCount,
            'usersRole4ByProgram' => $usersRole4ByProgram,
        ];
    }

    public function getProgramHeadKpis($programId)
    {
        // 1. Usuarios role_id 4 del mismo programa
        $studentCount = User::where('role_id', 4)
            ->where('program_id', $programId)
            ->count();

        // 2. Chats de usuarios role_id 4 del mismo programa
        $totalChats = Chat::whereHas('user', function ($query) use ($programId) {
            $query->where('role_id', 4)
                ->where('program_id', $programId);
        })->count();

        // 3. Chats de HOY (role_id 4, mismo programa)
        $chatsToday = Chat::whereHas('user', function ($query) use ($programId) {
            $query->where('role_id', 4)
                ->where('program_id', $programId);
        })->whereDate('created_at', Carbon::today())->count();

        // 4. Mensajes y Respuestas HOY (en general para el programa)
        // Optimizamos contando sobre los modelos Message y Response filtrando por la relación
        $messagesToday = Message::whereHas('chat.user', function ($query) use ($programId) {
            $query->where('role_id', 4)
                ->where('program_id', $programId);
        })->whereDate('created_at', Carbon::today())->count();

        $responsesToday = Response::whereHas('message.chat.user', function ($query) use ($programId) {
            $query->where('role_id', 4)
                ->where('program_id', $programId);
        })->whereDate('created_at', Carbon::today())->count();

        // Para cumplir "cuantos messages y response POR CHAT se han hecho por hoy", es posible que se requiera el promedio
        // o el desglose. Si es desglose, traemos la lista. Si es total, lo dejamos arriba.
        // Asumiremos TOTALES para el dashboard, pero si se requiere lista:
        /*
        $chatsTodayList = Chat::whereHas('user', function ($q) use ($programId) {
            $q->where('role_id', 4)->where('program_id', $programId);
        })
        ->whereDate('created_at', Carbon::today())
        ->withCount(['messages' => function($q){ $q->whereDate('created_at', Carbon::today()); }])
        // ->withCount(['responses' ...]) // Response es hasOne de Message, es más complejo contar directo con withCount anidado sin custom relation
        ->get();
        */

        return [
            'studentCount' => $studentCount,
            'totalChats' => $totalChats,
            'chatsToday' => $chatsToday,
            'messagesToday' => $messagesToday,
            'responsesToday' => $responsesToday,
        ];
    }
}
