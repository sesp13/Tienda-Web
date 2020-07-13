<?php

namespace App\Logic;

use App\Models\Category;

class CategoryLogic
{
    //LÓGICA PARA OBTENER 1 CATEGORÍA

    public static function getById(int $id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    //LÓGICA PARA OBTENER UN CONJUNTO DE CATEGORÍAS

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

    /*
        Retorna un número especificado de categorías
    */
    public static function getSome(int $number)
    {
        $categories = Category::take($number)->get();

        return $categories;
    }

    //LÓGICA QUE ABSTRAE UNA FUNCIONALIDAD

    /* 
        Guarda una categoría en la base de datos
    */
    public static function save(array $data): void
    {
        $category = new Category();

        $category->name = $data['name'];

        $category->save();
    }

    /*
        Actualiza una categoría en la base de datos
    */
    public static function update(Category $category, array $data)
    {
        $category->name = $data['name'];

        $category->update();
    }

    /*
        Elimina una categoría en la base de datos
    */
    public static function delete(int $id)
    {
        $category = self::getById($id);

        $category->delete();

        return $category;
    }
}
