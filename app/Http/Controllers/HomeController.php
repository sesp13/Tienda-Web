<?php

namespace App\Http\Controllers;

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
            ['title' => 'Productos', 'url' => 'home']
        ];

        return view('home', [
            'banner1Title' => $banner1Title,
            'banner1Links' => $banner1Links,
            'banner2Title' => $banner2Title,
            'banner2Links' => $banner2Links
        ]);
    }
}
