@extends('layouts.app')

@section('title', "Buscar Categorías")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    Te puede interesar
                </div>
                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Inicio</a>
                        </li>
                        <li>
                            <a href="{{ route('categories.index') }}">Todas las categorías</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <h1 class="page-banner">Resultados de búsqueda</h1>
            <h2 class="mt-4">Buscaste: {{ $search }}</h2>
            @if(count($categories) > 0)
            @include('partials.categories.category-grid')
            @else
            <h3>No hay coincidencias</h3>
            @endif
            <a href="{{ route('categories.index') }}">Volver al panel de categorías</a>
        </div>
    </div>
</div>

@endsection