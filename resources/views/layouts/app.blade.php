<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm p-4">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(isset($categories) && count($categories) > 0)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorías <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{ route('categories.index') }}" class="dropdown-item m-0">
                                    Todas las categorías
                                </a>
                                <hr class="mt-1 mb-1">
                                @foreach($categories as $categorie)
                                <a href="{{ route('products.get-by-categorie', $categorie->id ) }}" class="dropdown-item">
                                    {{ $categorie->name }}
                                </a>
                                @endforeach
                            </div>
                        </li>
                        @endif
                        <li class="nav-item nav-link">
                            Nosotros
                        </li>
                        <li class="nav-item nav-link">
                            Contacto
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('Login') }}
                            </a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item d-flex">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fa fa-address-book" aria-hidden="true"></i> {{ __('Register') }}
                            </a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item nav-link d-flex">
                            <i class="fa fa-cart-arrow-down cart-icon" aria-hidden="true" tooltip="Carrito de compra"></i>
                        </li>
                        <li class="nav-item dropdown d-flex justify-content-center align-items-center">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="admin-banner"> {{ Auth::user()->role == "ROLE_ADMIN" ? '(ADMIN)' : ''}}</span>
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @if(Auth::user()->role == "ROLE_ADMIN")
                                <a href="{{ route('admin.index') }}" class="dropdown-item">
                                    <i class="fa fa-area-chart" aria-hidden="true"></i> Panel de administrador
                                </a>
                                @else
                                <a href="{{ route('user.profile') }}" class="dropdown-item">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i> Mi perfil
                                </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-dark text-center text-white p-4">
            Desarrollado por SESP13 DEVELOPMENTS &copy; {{ date('yy') }}
        </footer>
    </div>
</body>

</html>