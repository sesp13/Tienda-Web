<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('active');
    }

    /*
        Retornamos una vista con los nombres de todas las categorías de la plataforma
    */
    public function index()
    {
        $categories = Category::paginate(5);

        return view('category.index', [
            'categories' => $categories,
            'searchUrl' => 'categories.load-search',
            'searchMessage' => 'Buscar categorías'
        ]);
    }

    public function loadCategory(Request $request)
    {
        $search = $request->input('search');

        return redirect()->route('categories.search', $search);
    }

    public function categorySearch($search)
    {
        $categories = Category::where('name', 'like', "%$search%")
            ->paginate(5);

        return view('category.search',[
            'categories' => $categories,
            'search' => $search
        ]);
    }
}
