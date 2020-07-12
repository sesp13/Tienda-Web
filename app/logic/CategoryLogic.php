<?php

namespace App\Logic;

use App\Models\Category;

class CategoryLogic
{
    /*
        Retorna todas las categorías
        opcional: parámetro de paginación
    */
    public static function getAll(int $pagination = null)
    {
        if ($pagination != null) {
            $categories = Category::paginate($pagination);
        } else {
            $categories = Category::all();
        }

        return $categories;
    }

    //LÓGICA PARA OBTENER 1 CATEGORÍA

    public static function getById(int $id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    //LÓGICA PARA OBTENER UN CONJUNTO DE CATEGORÍAS

    /*
        Retorna las categorías de acuerdo a una búsqueda
        opcional: parámetro de paginación
    */
    public static function getBySearch(string $search, int $pagination = null)
    {
        if ($pagination != null) {
            $categories = Category::where('name', 'like', "%$search%")
                ->paginate($pagination);
        } else {
            $categories = Category::where('name', 'like', "%$search%")
                ->get();
        }

        return $categories;
    }
}
