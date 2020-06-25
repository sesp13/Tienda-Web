<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Este middleware comprueba que se solicite un recurso del usuario autenticado
        // o que el usuario autenticado sea administrador
        $user = Auth::user();

        if ($user->role == "ROLE_ADMIN" || strval($user->id) == $request->id) {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }
}
