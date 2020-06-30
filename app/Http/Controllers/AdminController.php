<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Propiedades para la búsqueda de usuarios
    private $loadUrl = 'admin.users.load';
    private $searchUrl = 'admin.users.search';

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
        return view('admin.index');
    }

    // GESTION DE USUARIOS

    //Devuelve una vista dedicada para los usuarios de la plataforma
    public function users()
    {
        $users = User::where('role', 'ROLE_USER')->paginate(6);

        //Urls para el banner inferior Vista (partials.down-banners-2)
        //Estructura del array
        //['title' => "Texto para la url", 'url' => "Nombre de la url a redirigir"]

        //banner izquierdo
        $banner1Title = "Información útil sobre usuarios";
        $banner1Links = [
            ['title' => 'Usuarios sin confirmar', 'url' => 'admin.users-unconfirmed'],
            ['title' => 'Usuarios confirmados', 'url' => 'admin.users-confirmed'],
            ['title' => 'Usuarios deshabilitados', 'url' => 'admin.users-inactive'],
            ['title' => 'Usuarios habilitados', 'url' => 'admin.users-active'],
        ];

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Panel de administrador', 'url' => 'admin.index']
        ];

        return view('admin.users.index', [
            'users' => $users,
            'searchMessage' => "Buscar Usuarios",
            'searchUrl' => $this->loadUrl,
            'search'  => '',
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }

    /*
        Esta función recibe una petición de búsqueda,
        la procesa y redirige a la vista correspondiente
    */

    public function loadSearch(Request $request)
    {
        $search = $request->input('search');

        return redirect()->route($this->searchUrl, $search);
    }

    /*
        Esta función permite buscar un usuario en la base de datos por diferentes
        coindidencias en el criterio de búsqueda, sive para un buscador
    */
    public function userSearch(string $search)
    {
        $users = User::where('nit', 'like', "%$search%")
            ->orWhere('name', 'like', "%$search%")
            ->orWhere('surname', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->paginate(10);

        return view('admin..users.users-search', [
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
        if ($search != null) {
            return redirect()->route('admin.users.search', $search)->with('message', "Cambio de estado exitoso");
        } else {
            return back()->with('message', "Cambio de estado exitoso");
        }
    }

    // REPORTES DE USUARIO

    /*
        Me devuelve un reporte de los usuarios sin confirmar
    */
    public function usersUnconfirmed()
    {
        $users = User::where('role', 'ROLE_USER')
            ->where('confirmed', false)
            ->paginate(10);

        $sectionTitle = "Usuarios sin confirmar";
        $pageTitle = "Usuarios sin confirmar";

        return view('layouts.user.user-report', [
            'users' => $users,
            'pageTitle' => $pageTitle,
            'sectionTitle' => $sectionTitle,
        ]);
    }

    /*
        Me devuelve un reporte de los usuarios sin confirmar
    */
    public function usersConfirmed()
    {
        $users = User::where('role', 'ROLE_USER')
            ->where('confirmed', true)
            ->paginate(10);

        $sectionTitle = "Usuarios confirmados";
        $pageTitle = "Usuarios confirmados";

        return view('layouts.user.user-report', [
            'users' => $users,
            'pageTitle' => $pageTitle,
            'sectionTitle' => $sectionTitle,
        ]);
    }

    /*
        Me devuelve un reporte de los usuarios inhablitados
    */
    public function usersInactive()
    {
        $users = User::where('role', 'ROLE_USER')
            ->where('active', false)
            ->paginate(10);

        $sectionTitle = "Usuarios deshabilitados";
        $pageTitle = "Usuarios deshabilitados";

        return view('layouts.user.user-report', [
            'users' => $users,
            'pageTitle' => $pageTitle,
            'sectionTitle' => $sectionTitle,
        ]);
    }

    /*
        Me devuelve un reporte de los usuarios habilitados
    */
    public function usersActive()
    {
        $users = User::where('role', 'ROLE_USER')
            ->where('active', true)
            ->paginate(10);

        $sectionTitle = "Usuarios hablitados";
        $pageTitle = "Usuarios habilitados";

        return view('layouts.user.user-report', [
            'users' => $users,
            'pageTitle' => $pageTitle,
            'sectionTitle' => $sectionTitle,
        ]);
    }

    //GESTION DE CATEGORÍAS

    /*
        Despliega todas las categorías de la plataforma
    */
    public function categories()
    {
        $categories = Category::paginate(7);

        return view('admin.categories.index', [
            'categories' => $categories,
            'searchUrl' => 'categories.load-search',
            'searchMessage' => 'Buscar categorías'
        ]);
    }

    /*
        Regresa una vista para crear una categoría
    */
    public function categorieCreate()
    {
        $category = new Category();

        return view('admin.categories.create', [
            'category' => $category,
            'edit' => false,
            'postUrl' => 'admin.categories.store'
        ]);
    }

    /*
        Se guarda una nueva categoría en la base de datos
    */
    public function categorieStore(Request $request)
    {
        // Validar los datos
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:categories,name"]
        ]);

        $category = new Category();

        $category->name = $data['name'];

        $category->save();

        return redirect()->route('admin.categories')->with('message', "Categoría guardada correctamente");
    }

    /*
        Se carga la vista para editar una categoría en la base de datos
    */
    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.create', [
            'category' => $category,
            'edit' => true,
            'postUrl' => 'admin.categories.update'
        ]);
    }

    public function categoryUpdate(Request $request)
    {
        $category = Category::find($request->input('id'));

        // Validar los datos
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:categories,name," . $category->id]
        ]);

        $category->name = $data['name'];

        $category->update();

        return redirect()->route('admin.categories')->with('message', "Categoría actualizada correctamente");
    }

    public function categoryDelete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.categories')
            ->with('message', "La categoría {$category->name} ha sido eliminada correctamente");
    }
}
