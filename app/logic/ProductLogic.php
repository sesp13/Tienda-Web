<?php

namespace App\Logic;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/*
    Esta clase abstrae la lógica necesaria cuando se
    interactúa con la base de datos para obtener productos
*/

class ProductLogic
{
    //LÓGICA PARA OBTENER 1 PRODUCTO

    /*
        Obtiene un producto por su id
    */
    public static function getById(int $id)
    {
        $product = Product::findOrFail($id);

        return $product;
    }

    //LÓGICA PARA OBTENER UN CONJUNTO DE PRODUCTOS

    /*
        Retorna los productos ordenados por una columna
        la forma de ordenado ascendente o descendente es opcional
        la paginación de los productos es opcional
    */
    public static function getAllOrderByCustom(string $column, bool $way = true, int $pagination = null)
    {
        $orderWay = $way ? 'asc' : 'desc';

        if ($pagination != null) {
            $products = Product::orderBy($column, $orderWay)
                ->paginate($pagination);
        } else {
            $products = Product::orderBy($column, $orderWay)
                ->get();
        }

        return $products;
    }

    /*
        Retorna los productos activos ordenados por una columna
        la forma de ordenado ascendente o descendente es opcional
        la paginación de los productos es opcional
    */
    public static function getAllActiveOrderByCustom(string $column, bool $way = true, int $pagination = null)
    {
        $orderWay = $way ? 'asc' : 'desc';

        if ($pagination != null) {
            $products = Product::where('active', true)
                ->orderBy($column, $orderWay)->paginate($pagination);
        } else {
            $products = Product::where('active', true)
                ->orderBy($column, $orderWay)->get();
        }

        return $products;
    }

    /*
        Retorna los productos asociados a una categoría
        la paginación de los productos es opcional
    */
    public static function getActiveByCategory(int $categoryId, int $pagination = null)
    {
        if ($pagination != null) {
            $products = Product::where('category_id', $categoryId)
                ->where('active', true)
                ->paginate($pagination);
        } else {
            $products = Product::where('category_id', $categoryId)
                ->where('active', true)
                ->get();
        }

        return $products;
    }

    /*
        Retorna los productos sin categoría
        la paginación de los productos es opcional
    */
    public static function getActiveWithoutCategory(int $pagination = null)
    {
        if ($pagination != null) {
            $products = Product::where('category_id', null)
                ->where('active', true)
                ->paginate($pagination);
        } else {
            $products = Product::where('category_id', null)
                ->where('active', true)
                ->get();
        }

        return $products;
    }

    /*
        Retorna los productos que satisfagan el criterio de búsqueda y que sean activos
        la paginación de los productos es opcional
    */
    public static function getBySearch(string $search, int $pagination = null)
    {
        if ($pagination != null) {
            $products = Product::where('id', 'like', "%$search%")
                ->orWhere('alt_code', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->paginate($pagination);
        } else {
            $products = Product::where('id', 'like', "%$search%")
                ->orWhere('alt_code', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->get();
        }

        return $products;
    }

    /*
        Retorna los productos que satisfagan el criterio de búsqueda y que sean activos
        la paginación de los productos es opcional
    */
    public static function getActiveBySearch(string $search, int $pagination = null)
    {
        if ($pagination != null) {
            // Condicional tipo (or) and ()
            $products = Product::where(function ($query) use ($search) {
                $query->where('id', 'like', "%$search%")
                    ->orWhere('alt_code', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })->where('active', true)
                ->paginate($pagination);
        } else {
            $products = Product::where(function ($query) use ($search) {
                $query->where('id', 'like', "%$search%")
                    ->orWhere('alt_code', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })->where('active', true)
                ->get();
        }

        return $products;
    }

    /*
        Retorna una cantidad de productos especificada, 
        además no se incluye un producto determinado
    */
    public static function getRandomActiveWithoutOneProduct(int $number, Product $product)
    {
        $products = Product::take($number)
            ->where('active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->get()->load('category');

        return $products;
    }

    /*
        Obtener algunos productos ordenados por una columna especifica
    */
    public static function getSomeOrderByCustom(int $number, string $column, bool $way = true)
    {
        $orderWay = $way ? 'asc' : 'desc';
        $products = Product::take($number)
            ->where('active', true)->orderBy($column, $orderWay)
            ->get()->load('category');

        return $products;
    }

    //LÓGICA QUE ABSTRAE UNA FUNCIONALIDAD

    /*
        Guarda un producto en la base de datos
    */
    public static function save(array $data): void
    {
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
    }

    /*
        Actualiza un producto en la base de datos
    */
    public static function update(Product $product, array $data): void
    {
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
    }

    /*
        Elimina un producto de la base de datos
    */
    public static function delete(int $id)
    {
        $product = self::getById($id);

        if ($product->image_path != null) {
            Storage::disk('product_images')->delete($product->image_path);
        }

        $product->delete();

        return $product;
    }

    /*
        Se cambia el atributo active de producto
        ya sea para habilitarlo o deshabilitarlo
    */
    public static function changeState(int $id)
    {
        $product = Product::findOrFail($id);

        $product->active = !$product->active;

        $product->update();

        return $product;
    }
}
