<?php

namespace App\Logic;

use App\User;

/*
    Esta clase abstrae la lógica necesaria cuando se
    interactúa con la base de datos para obtener usuarios
*/
class UserLogic
{

    /*
        Retorna todos los usuarios
        opcional: parámetro de paginación
    */
    public static function getAll(int $pagination = null)
    {
        if ($pagination != null) {
            $users = User::where('role', 'ROLE_USER')->paginate($pagination);
        } else {
            $users = User::where('role', 'ROLE_USER')->get();
        }

        return $users;
    }

    //LÓGICA PARA OBTENER 1 USUARIO 

    /*
        Retorna un usuario por su id
    */
    public static function getById(int $id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /*
        Retorna un usuario por su email token
    */
    public static function getByEmailToken(string $token)
    {
        $user = User::where('email_token', $token)
            ->firstOrFail();

        return $user;
    }

    //LÓGICA PARA OBTENER UN CONJUNTO DE USUARIOS

    /*
        Retorna los usuarios de acuerdo a una búsqueda
        opcional: Parámetro de paginación
    */
    public static function getBySearch(string $search, int $pagination = null)
    {

        if ($pagination != null) {
            $users = User::where('nit', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('surname', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->paginate($pagination);
        } else {
            $users = User::where('nit', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('surname', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->get();
        }

        return $users;
    }

    /*
        Retorna los usuarios confirmados
        opcional: parámetro de paginación
    */
    public static function getConfirmed(int $pagination = null)
    {
        if ($pagination != null) {
            $users = User::where('role', 'ROLE_USER')
                ->where('confirmed', true)
                ->paginate($pagination);
        } else {
            $users = User::where('role', 'ROLE_USER')
                ->where('confirmed', true)
                ->get();
        }

        return $users;
    }

    /*
        Retorna los usuarios sin confirmar
    */
    public static function getUnconfirmed(int $pagination = null)
    {
        if ($pagination != null) {
            $users = User::where('role', 'ROLE_USER')
                ->where('confirmed', false)
                ->paginate($pagination);
        } else {
            $users = User::where('role', 'ROLE_USER')
                ->where('confirmed', false)
                ->get();
        }

        return $users;
    }

    /*
        Retorna los usuarios activos (habilitados)
        opcional: parámetro de paginación
    */
    public static function getActive(int $pagination = null)
    {
        if ($pagination != null) {
            $users = User::where('role', 'ROLE_USER')
                ->where('active', true)
                ->paginate($pagination);
        } else {
            $users = User::where('role', 'ROLE_USER')
                ->where('active', true)
                ->get();
        }
    }

    /*
        Retorna los usuarios inactivos (inhabilitados)
        opcional: parámetro de paginación
    */
    public static function getInactive(int $pagination = null)
    {
        if ($pagination != null) {
            $users = User::where('role', 'ROLE_USER')
                ->where('active', false)
                ->paginate($pagination);
        } else {
            $users = User::where('role', 'ROLE_USER')
                ->where('active', false)
                ->get();
        }
    }

    //LÓGICA QUE ABSTRAE UNA FUNCIONALIDAD

    /*
        Si el usuario es administrador retorna true, 
        en caso contrario retorna false
    */
    public static function isAdmin(User $user): bool
    {
        if ($user->role = "ROLE_ADMIN") {
            return true;
        } else {
            return false;
        }
    }

    /*
        Cambia el atributo active de user para saber si está habilitado o no
    */
    public static function changeState(int $id)
    {
        $user = self::getById($id);

        $state = $user->active;

        $user->active = !$state;

        $user->update();

        return $user;
    }
}
