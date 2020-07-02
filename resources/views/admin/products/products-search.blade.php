@extends('layouts.app')

@section('title', "Resultados de búsqueda")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Resultados de búsqueda</h1>
                </div>
                <div class="card-body">
                    <h2>Buscaste: {{ $search }}</h2>
                    @include('partials.message')
                    @if(count($products) > 0)
                    @include('partials.admin.product-table')
                    <div class="justify-content-center d-flex">
                        {{ $products->links() }}
                    </div>
                    @else:
                    <h3>No hay coincidencias</h3>
                    @endif
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