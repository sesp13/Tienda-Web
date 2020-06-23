<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /*
        Devuelve la vista principal del panel de administrador
    */
    public function index()
    {
        $users = User::where('role', 'ROLE_USER')->paginate(10);

        return view('admin.index', [
            'users' => $users
        ]);
    }

    //Devuelve una vista dedicada para los usuarios de la plataforma
    public function users()
    {
        $users = User::where('role', 'ROLE_USER')->paginate(10);

        return view('admin.users', [
            'users' => $users
        ]);
    }

    //Cambia la propiedad active del usuario, para saber si está habilitado o no
    public function changeUserState(int $id)
    {
        $user = User::findOrFail($id);

        $state = $user->active;

        $user->active = !$state;

        $user->update();

        return back()->with('message', "Cambio de estado exitoso");
    }
}
