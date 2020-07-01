<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;

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
        $products = Product::paginate(9);

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

        return view('layouts.product.product-report',[
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
        $products = Product::where('category_id', $category->id)->paginate(9);

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

        return view('layouts.product.product-report',[
            'sectionTitle' => "Productos de {$category->name}",
            'pageTitle' => "Productos de {$category->name}",
            'products' => $products,
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links 
        ]);
    }
}
