@extends('layouts.app')

@section('title', $sectionTitle)

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="page-banner">{{ $pageTitle }}</h1>
            @if(count($products) > 0)
            @include('partials.products.product-grid')
            <div class="d-flex justify-content-center mt-3">
                {{ $products->links() }}
            </div>
            @else
            <h2 class="my-4">No hay productos para mostrar en el momento</h2>
            @endif
        </div>
    </div>
    @include('partials.down-banners-2')
</div>

@endsection