<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;

class ProductController extends Controller
{

    /*
      Retornamos una vista con todos los productos asociados a una categoría
    */
    public function getProductsByCategory($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $category->id)->paginate(9);

        //Contenido de los banners inferiores

        //banner izquierdo
        $banner1Title = "Enlaces útiles";
        $banner1Links = [
            ['title' => 'Categorías de la tienda', 'url' => 'categories.index'],
        ];

        //Banner derecho
        $banner2Title = "Te puede interesar";
        $banner2Links = [
            ['title' => 'Home', 'url' => 'home']
        ];

        return view('product.showByCategory', [
            'category' => $category,
            'products' => $products,
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }
}
