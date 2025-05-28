<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Sessions;

class VerifySessionToken
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $token = session('session_token');

            // Validar si la sesión aún existe
            $session = Sessions::where('session_token', $token)->first();

            if (! $session) {
                // Cerrar sesión si ya no existe en la base de datos
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors([
                    'email' => 'Tu sesión ha sido cerrada por seguridad.',
                ]);
            }
        }

        return $next($request);
    }
}

