@extends('layouts.app')

@section('title', "Categorías")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    Barra lateral
                </div>
                <div class="card-body">
                    <a href="{{ route('home') }}">Inicio</a>
                    @include('partials.search-lines')
                    <a href="{{ route('products.without-categorie') }}" class="mt-3 d-block">Productos sin categoría</a>
                </div>
            </div>
        </div>
        <div class="col-9">

            <h1 class="page-banner">Categorías</h1>
            @include('partials.categories.category-grid')
        </div>
    </div>
</div>

@endsection