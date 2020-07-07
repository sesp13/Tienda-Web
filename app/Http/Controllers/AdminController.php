<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        //Urls para el banner lateral Vista (partials.vertical-banners-2)
        //Estructura del array
        //['title' => "Texto para la url", 'url' => "Nombre de la url a redirigir"]

        //banner izquierdo
        $banner1TitleV = "Información útil sobre categorías";
        $banner1VLinks = [];

        //Banner derecho
        $banner2TitleV = "Te puede interesar";
        $banner2VLinks = [
            ['title' => 'Panel de administrador', 'url' => 'admin.index']
        ];


        return view('admin.categories.index', [
            'categories' => $categories,
            'searchUrl' => 'admin.categories.load-search',
            'searchMessage' => 'Buscar categorías',
            'banner1TitleV' => $banner1TitleV,
            'banner1VLinks' => $banner1VLinks,
            'banner2TitleV' => $banner2TitleV,
            'banner2VLinks' => $banner2VLinks
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
    public function categoryEdit(int $id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.create', [
            'category' => $category,
            'edit' => true,
            'postUrl' => 'admin.categories.update'
        ]);
    }

    /*
        Actualizar una categoría en la base de datos
    */
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

    /*
        Eliminar una categoría en la base de datos
    */
    public function categoryDelete(int $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('admin.categories')
            ->with('message', "La categoría {$category->name} ha sido eliminada correctamente");
    }

    /*
        Carga la búsqueda de una categoría en la base de datos
    */
    public function loadCategorySearch(Request $request)
    {
        $search = $request->input('search');
        return redirect()->route('admin.categories.search', $search);
    }

    /*
        Busca las categorías que coincidan con el criterio
    */
    public function categorySearch(string $search)
    {
        $categories = Category::where('name', 'like', "%$search%")
            ->paginate(5);

        return view('admin.categories.categories-search', [
            'categories' => $categories,
            'search' => $search
        ]);
    }

    //GESTION DE PRODUCTOS

    /*
        Retorna una vista con todos los productos de la plataforma
    */
    public function products()
    {
        $products = Product::orderBy('updated_at', 'desc')->paginate(10);

        //Propiedades para los banners inferiores
        $banner1Title = "Enlaces útiles";
        $banner1Links = [];

        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => "Panel de administrador", 'url' => 'admin.index']
        ];

        return view('admin.products.index', [
            'products' => $products,
            'searchMessage' => 'Buscar productos',
            'searchUrl' => 'admin.products.load-search',
            'search' => '',
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }

    /*
        Se usa para cambiar el estado active de un producto
        Se redirige a una ruta que despliega una lista de productos
    */
    public function changeProductState(int $id, string $search = null)
    {
        $product = Product::findOrFail($id);

        $product->active = !$product->active;

        $product->update();

        //Search se usa para devolverse a la vista de búsqueda de producto
        if ($search != null) {
            return redirect()->route('admin.products.search', $search)
                ->with('message', "Cambio de estado exitoso");
        } else {
            return back()->with('message', "{$product->name} ha cambiado de estado satisfactoriamente");
        }
    }

    /*
       Procesa la petición de búsqueda de productos y redirecciona a un método
       por GET con los resultados 
    */
    public function loadProductSearch(Request $request)
    {
        $search = $request->input('search');

        return redirect()->route('admin.products.search', $search);
    }

    /*
        Se busca en la base de datos las coincidencias de búsqueda y
        se retorna una vista con los resultados
    */
    public function productSearch(string $search)
    {
        $products = Product::where('id', 'like', "%$search%")
            ->orWhere('alt_code', 'like', "%$search%")
            ->orWhere('name', 'like', "%$search%")
            ->orWhere('price', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->paginate(10);

        return view('admin.products.products-search', [
            'products' => $products,
            'search' => $search
        ]);
    }

    /*
        Se retona una vista para crear un producto
    */
    public function productCreate()
    {
        $product = new Product();
        $categories = Category::all();

        return view('admin.products.create', [
            'product' => $product,
            'categories' => $categories,
            'edit' => false,
            'url' => 'admin.products.store'
        ]);
    }

    /*
        Se guarda un producto en la BD,
        se retorna una redireccion a la ruta de
        la vista principal de productos en la plataforma
    */
    public function productStore(Request $request)
    {

        $data = $request->validate([
            'alt_code' => ['nullable', 'unique:products,alt_code'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'image_path' => ['image', 'mimes:jpg,jpeg,png,gif'],
            'stock' => ['numeric', 'required', ''],
            'category_id' => [],
            'description' => [],
            'active' => [],
        ]);

        //Guardado del producto
        $product = new Product();

        $product->alt_code = $data['alt_code'];
        $product->category_id = $data['category_id'];
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->active = $data['active'];

        if (isset($data['image_path'])) {
            $image_path = $data['image_path'];
        } else {
            $image_path = null;
        }

        //Guardado de la imagen
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('product_images')->put($image_path_name, File::get($image_path));
            $product->image_path = $image_path_name;
        }

        $product->save();

        return redirect()->route('admin.products')->with('message', 'producto creado correctamente');
    }

    /*
        Se retorna una vista para editar un producto
    */
    public function productEdit(int $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.create', [
            'product' => $product,
            'categories' => $categories,
            'edit' => true,
            'url' => 'admin.products.update'
        ]);
    }

    /*
        Actualiza un producto en la base de datos,
        si se tiene éxito, se retorna a la ruta del panel de productos
    */
    public function productUpdate(Request $request)
    {
        $id = $request->input('id');

        $product = Product::findOrFail($id);

        $data = $request->validate([
            'alt_code' => ['nullable', 'unique:products,alt_code,' . $id],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'image_path' => ['image', 'mimes:jpg,jpeg,png,gif'],
            'stock' => ['numeric', 'required', ''],
            'category_id' => [],
            'description' => [],
            'active' => [],
        ]);

        $product->alt_code = $data['alt_code'];
        $product->category_id = $data['category_id'];
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->active = $data['active'];

        if (isset($data['image_path'])) {
            $image_path = $data['image_path'];
        } else {
            $image_path = null;
        }

        //Guardado de la imagen
        if ($image_path) {
            if ($product->image_path != null) {
                Storage::disk('product_images')->delete($product->image_path);
            }
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('product_images')->put($image_path_name, File::get($image_path));
            $product->image_path = $image_path_name;
        }

        $product->update();

        return redirect()->route('admin.products')->with('message', "El producto {$product->name} ha sido editado correctamente");
    }

    /*
        Elimina un producto de la base de datos
    */
    public function productDelete(int $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_path != null) {
            Storage::disk('product_images')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('message', "El producto {$product->name} ha sido eliminado correctamente");
    }
}
