<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('active');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::take(6)
            ->where('active', true)->orderBy('created_at', 'desc')
            ->get()->load('category');

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [];

        if (Auth::user() == null) {
            array_push($banner1Links, ['title' => 'Registro', 'url' => 'register']);
            array_push($banner1Links, ['title' => 'Login', 'url' => 'login']);
        } else {
            array_push($banner1Links, ['title' => 'Mi Perfil', 'url' => 'user.profile']);
        }

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Productos', 'url' => 'products.index'],
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index']
        ];

        return view('home', [
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links,
            'searchMessage' => "Buscar Productos",
            'searchUrl' => 'products.load-search',
            'categories' => Category::take(10)->get(),
            'products' => $products
        ]);
    }
}
