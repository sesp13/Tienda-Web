<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function confirm($token)
    {
        //Obtencion del usuario por medio de su token de correo
        $user = User::where('email_token', $token)
            ->firstOrFail();

        //Actualizacion de campos
        $user->email_token = null;
        $user->confirmed = true;
        $user->active = true;

        $user->update();

        return view('user.confirm', [
            'user' => $user
        ]);
    }

    // Método dedicado todos los usuarios no identificados
    public function unconfirmed()
    {
        //Redireccionamos a los usuarios no autenticados de esta ruta
        $user = Auth::user();
        if($user == null){
            return redirect()->route('login');
        }

        //Se retorna una vista que deben ver todos los usuarios que no han confirmado su contraseña
        return view('user.unconfirmed', [
            'message' => "Debes de confirmar tu correo para poder acceder a la plataforma"
        ]);
    }
}
