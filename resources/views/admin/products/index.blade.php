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