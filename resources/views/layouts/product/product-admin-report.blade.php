<?php
/*
        Se requiere
        $products: array de productos paginados
        $sectionTitle = Nombre de la sección de la web
        $pageTitle = Nombre de la página
    */
?>

@extends('layouts.app')

@section('title', $sectionTitle)

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">{{ $pageTitle }}</h1>
                </div>
                <div class="card-body">
                    @include('partials.message')
                    @include('partials.admin.product-table')
                </div>
                <div class="justify-content-center d-flex">
                    {{ $products->links() }}
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.products') }}">Volver al panel de productos</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection