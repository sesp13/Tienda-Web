<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //Proetcción de rutas para usuario autenticado o administrador
        $this->middleware('auth')->only('edit', 'update', 'profile');
        $this->middleware('userOrAdmin')->only('edit', 'update');
        $this->middleware('user.confirm')->only('profile');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', [
            'user' => $user,
            'url' => 'user.update'
        ]);
    }

    //Actualizamos el usuario en la DB
    public function update(Request $request)
    {
        $user = User::find($request->input('id'));

        // Validar los datos
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email," . $user->id],
        ]);

        //Seteo de los campos del usuario
        $user->update($data);

        return back()->with('message', "Usuario actualizado correctamente");
    }

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
        if ($user == null) {
            return redirect()->route('login');
        }

        //Se retorna una vista que deben ver todos los usuarios que no han confirmado su contraseña
        return view('user.unconfirmed', [
            'message' => "Debes de confirmar tu correo para poder acceder a la plataforma"
        ]);
    }

    /*
        Carga la vista del perfil del usuario
    */
    public function profile()
    {
        $user = Auth::user();

        return view('user.profile', [
            'user' => $user
        ]);
    }

    public function mail(){
        $msg = [
            'name' => "Simón",
            'surname' => "Cano",
            'email' => "correo@correo.com",
            "email_token" => "15927814788783843541184755827"
        ];

        return view('email.confirm', [
            'msg' => $msg
        ]);
    }
}
