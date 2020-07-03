@extends('layouts.app')

@section('title', "Gestión de productos")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Productos de la plataforma</h1>
                </div>
                <div class="card-body">
                    @include('partials.search')
                    @include('partials.message')
                    <div class="my-3 float-right">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Crear nuevo producto</a>
                        <div class="clearfix"></div>
                    </div>
                    @include('partials.admin.product-table')
                </div>
                <div class="justify-content-center d-flex">
                    {{ $products->links() }}
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.index') }}">Volver al panel de administrador</a>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@endsection