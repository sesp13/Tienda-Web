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
        $searchUrl = 'admin.users.search';

        return view('admin.users', [
            'users' => $users,
            'searchUrl' => $searchUrl,
            'search'  => ''
        ]);
    }

    public function userSearch(Request $request, $search = null)
    {

        if($request->ismethod('post')){
            $search = $request->input('search');
        }

        $users = User::where('nit', 'like', "%$search%")
            ->orWhere('name', 'like', "%$search%")
            ->orWhere('surname', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->paginate(10);
        
        return view('admin.users-search',[
            'search' => $search,
            'users' => $users
        ]);

    }

    //Cambia la propiedad active del usuario, para saber si está habilitado o no
    public function changeUserState(int $id, string $search = null)
    {
        $user = User::findOrFail($id);

        $state = $user->active;

        $user->active = !$state;

        $user->update();

        //Search se usa para devolverse a la vista de búsqueda de usuario
        if($search != null){
            return redirect()->route('admin.users.search', $search)->with('message', "Cambio de estado exitoso");
        } else {
            return back()->with('message', "Cambio de estado exitoso");
        }
    }
}
