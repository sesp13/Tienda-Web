<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ConfirmUser
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
        //Este middleware verifica que el usuario esté confirmado en la plataforma
        $user = Auth::user();

        if ($user != null) {
            if ($user->confirmed) {
                return $next($request);
            } else {
                return redirect()->route('user.unconfirmed');
            }
        } else {
            return $next($request);
        }
    }
}
