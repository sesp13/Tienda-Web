<?php

namespace App\Http\Controllers;

use App\Logic\UserLogic;
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
        $this->middleware('active')->except('unconfirmed', 'inactive');
    }

    public function edit(int $id)
    {
        //Saber si el usuario autenticado es admin o no
        $user = Auth::user();
        $admin = UserLogic::isAdmin($user);

        //Conseguir el usuario asociado con el id de la url
        $user = UserLogic::getById($id);

        return view('user.edit', [
            'user' => $user,
            'url' => 'user.update',
            'admin' => $admin
        ]);
    }

    //Actualizamos el usuario en la DB
    public function update(Request $request)
    {
        $user = UserLogic::getById($request->input('id'));

        // Validar los datos
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email," . $user->id],
        ]);

        UserLogic::update($user, $data);

        return back()->with('message', "Usuario actualizado correctamente");
    }

    public function confirm(string $token)
    {
        //Obtencion del usuario por medio de su token de correo
        $user = UserLogic::getByEmailToken($token);

        UserLogic::confirm($user);

        return view('user.confirm', [
            'user' => $user
        ]);
    }

    // Método dedicado todos los usuarios no confirmados
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

    public function inactive()
    {
        //Redireccionamos a los usuarios no autenticados de esta ruta
        $user = Auth::user();
        if ($user == null) {
            return redirect()->route('login');
        }

        return view('user.inactive');
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

    public function mail()
    {
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
