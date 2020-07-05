<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('active');
    }

    /* 
        Retorna una vista con todos los productos
    */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(9);

        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index']
        ];

        $user = Auth::user();

        //Rutas exclusivas del administrador
        if ($user != null && $user->role == "ROLE_ADMIN") {
            $banner1Links[] = ['title' => '[ADMIN] Panel de categorías', 'url' => 'admin.categories'];
        }

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Home', 'url' => 'home']
        ];

        return view('layouts.product.product-report', [
            'sectionTitle' => 'Todos los productos',
            'pageTitle' => 'Todos los productos',
            'products' => $products,
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }

    /*
      Retorna una vista con todos los productos asociados a una categoría
    */
    public function getProductsByCategory(int $id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $category->id)
            ->where('active', true)
            ->paginate(9);

        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index']
        ];

        $user = Auth::user();

        //Rutas exclusivas del administrador
        if ($user != null && $user->role == "ROLE_ADMIN") {
            $banner1Links[] = ['title' => '[ADMIN] Panel de categorías', 'url' => 'admin.categories'];
        }

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Home', 'url' => 'home']
        ];

        return view('layouts.product.product-report', [
            'sectionTitle' => "Productos de {$category->name}",
            'pageTitle' => "Productos de {$category->name}",
            'products' => $products,
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }

    /*
        Se obtiene una imagen del disco virtual product_images
    */
    public function getImage(string $filename)
    {
        try {
            $file = Storage::disk('product_images')->get($filename);
        } catch (Exception $e) {
            $file = Storage::disk('public')->get('default.jpg');
        }
        return new Response($file, 200);
    }

    /*
       Procesa la petición de búsqueda de productos y redirecciona a un método
       por GET con los resultados 
    */
    public function loadSearch(Request $request)
    {
        $search = $request->input('search');

        return redirect()->route('products.search', $search);
    }

    /*
        Se busca en la base de datos las coincidencias de búsqueda y
        se retorna una vista con los resultados
    */
    public function search(string $search)
    {
        // Condicional tipo (or) and ()
        //Productos que satisfagan el criterio de búsqueda y que sean activos
        $products = Product::where(function ($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhere('alt_code', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        })->where('active', true)
            ->paginate(9);


        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index']
        ];

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Home', 'url' => 'home']
        ];

        return view('layouts.product.product-report', [
            'sectionTitle' => "Productos: Búsqueda",
            'pageTitle' => "Resultados de: $search",
            'products' => $products,
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }
}
