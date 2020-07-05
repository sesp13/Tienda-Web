@extends('layouts.app')

@section('title', $sectionTitle)

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="p-title">
                        {{ $product->name }}
                    </h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if($product->image_path)
                            <div class="photo-product-single">
                                <img src="{{ route('products.get-image',$product->image_path) }}" alt="">
                            </div>
                            @else
                            <div class="photo-product">
                                <img src="https://previews.123rf.com/images/themoderncanvas/themoderncanvas1605/themoderncanvas160500008/56739040-dise%C3%B1o-de-iconos-de-productos-org%C3%A1nicos-s%C3%ADmbolo-del-producto-org%C3%A1nico-sello-de-producto-org%C3%A1nico-con-dise%C3%B1o-de-for.jpg" alt="Imagen por defecto">
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-xs-12 col-md-6">
                            <p class="p-price">
                                Precio: <span class="currency"> {{ $product->price }}</span>
                            </p>
                            <a href="" class="btn btn-primary mb-3">
                                Agregar al carrito
                            </a>
                            <h3>Otros datos</h3>
                            <p>
                                <strong> Categoría </strong>
                                @if($product->category != null)
                                <a href="{{ route('products.get-by-categorie',$product->category->id) }}">
                                    {{ $product->category->name }}
                                </a>
                                @else
                                Sin categoría
                                @endif
                            </p>
                            <p>Unidades disponibles: {{ $product->stock }}</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <h2>Descripción</h2>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($product->category != null)
    @if( count($products) > 0)
    <h2 class="mt-4">Más productos de
        <a href="{{ route('products.get-by-categorie', $product->category_id) }}">
            {{ $product->category->name }}
        </a>
    </h2>
    @endif
    @else
    <h2>Más productos sin categoría</h2>
    @endif
    @include('partials.products.product-grid')
    @include('partials.down-banners-2')
</div>

@endsection