<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserActive
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
        /*
            Este middleware verifica que el usuario esté habilitado en la plataforma
            Primero se verifica si tiene el correo confirmado, 
            Luego se verifica si el usuario está habilitado.
            En caso de fallar estas pruebas se despliegan vistas de error.

            Nota: Este middleware no aplica si el usuario no está identificado o si es 
            administrador.
        */
        $user = Auth::user();

        if ($user != null) {
            if ($user->role != 'ROLE_ADMIN') {
                if ($user->confirmed) {
                    if ($user->active) {
                        return $next($request);
                    } else {
                        return redirect()->route('user.inactive');
                    }
                } else {
                    return redirect()->route('user.unconfirmed');
                }
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
