<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Si el usuario no está autenticado, redirigir al login
        if (!Auth::check()) {
            $programs = \App\Models\Program::all();

            return redirect()->route('login')->with('programs', $programs);
        }

        $user = Auth::user();

        if (in_array($user->role_id, $roles)) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'No tienes permiso para acceder a esta página');
    }
}
