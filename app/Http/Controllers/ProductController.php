<?php

namespace App\Http\Controllers;

use App\Logic\CategoryLogic;
use App\Logic\ProductLogic;
use App\Logic\UserLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('active');
        $this->middleware('product-active', [
            'only' => ['show']
        ]);
    }

    /* 
        Retorna una vista con todos los productos
    */
    public function index()
    {
        $products = ProductLogic::getAllActiveOrderByCustom('created_at', true, 9);

        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index']
        ];

        $user = Auth::user();

        //Rutas exclusivas del administrador
        if ($user != null && UserLogic::isAdmin($user)) {
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
    public function getProductsByCategory(int $categoryId)
    {
        $category = CategoryLogic::getById($categoryId);
        $products = ProductLogic::getActiveByCategory($categoryId, 9);

        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index']
        ];

        $user = Auth::user();

        //Rutas exclusivas del administrador
        if ($user != null && UserLogic::isAdmin($user)) {
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
      Retorna una vista con todos los productos sin categoría
    */
    public function getProductsWithoutCategory()
    {
        $products = ProductLogic::getActiveWithoutCategory(9);

        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index']
        ];

        $user = Auth::user();

        //Rutas exclusivas del administrador
        if ($user != null && UserLogic::isAdmin($user)) {
            $banner1Links[] = ['title' => '[ADMIN] Panel de categorías', 'url' => 'admin.categories'];
        }

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Home', 'url' => 'home']
        ];

        return view('layouts.product.product-report', [
            'sectionTitle' => "Productos sin categoría",
            'pageTitle' => "Productos sin categoría",
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
        $products = ProductLogic::getActiveBySearch($search, 9);

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

    /*
        Retorna la vista particular de un producto
    */

    public function show(int $id)
    {
        $product = ProductLogic::getById($id);

        $products = ProductLogic::getRandomActiveWithoutOneProduct(3, $product);

        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index']
        ];

        //Rutas exclusivas del administrador
        $user = Auth::user();
        if (isset($user)) {
            if (UserLogic::isAdmin($user)) {
                array_push($banner1Links, ['title' => '[ADMIN] Panel de productos', 'url' => 'admin.products']);
            }
        }

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Home', 'url' => 'home']
        ];

        return view('product.show', [
            'sectionTitle' => "Producto: {$product->name}",
            'product' => $product,
            'products' => $products,
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }

    public function getCheapProducts()
    {
        $products = ProductLogic::getSomeActiveOrderByCustom(30, 'price', true, 9);
        
        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index'],
            ['title' => 'Todos los productos', 'url' => 'products.index']
        ];

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Home', 'url' => 'home']
        ];

        return view('layouts.product.product-report', [
            'sectionTitle' => "Productos Baratos",
            'pageTitle' => "Productos económicos",
            'products' => $products,
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }

    public function getExpensiveProducts()
    {
        $products = ProductLogic::getSomeActiveOrderByCustom(30, 'price', false, 9);
        
        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index'],
            ['title' => 'Todos los productos', 'url' => 'products.index']
        ];

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Home', 'url' => 'home']
        ];

        return view('layouts.product.product-report', [
            'sectionTitle' => "Productos Costosos",
            'pageTitle' => "Productos costosos",
            'products' => $products,
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }
}
