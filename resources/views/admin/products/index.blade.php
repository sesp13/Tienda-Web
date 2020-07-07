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
                    <div class="my-3 float-left">
                        <p class="float-left">Total de productos en esta página: {{ count($products) }}</p>
                        <!-- <form action="" class="ml-3 form-inline float-left">
                        <div class="form-group">
                            <select name="" id="" class="form-control">
                                <option value="">Por precio</option>
                                <option value="">Por marca</option>
                                <option value="">Por imagen</option>
                            </select>
                        </div>
                            <input type="submit" class="ml-3 btn btn-success" value="Aplicar">
                        </form> -->
                    </div>
                    <div class="my-3 float-right">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Crear nuevo producto</a>
                    </div>
                    <div class="clearfix"></div>
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
    @include('partials.down-banners-2')
</div>
</div>

@endsection