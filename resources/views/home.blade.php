@extends('layouts.app')

@section('content')
<div class="container">
     <div class="web-title row">Tienda Web de SESP13</div>
     <div class="row my-3">
          <div class="col-12 d-block">
               <h1 class="main-banner">Últimos productos</h1>
               @include('partials.products.product-grid')
               <div class="float-right">
                    <a href="{{ route('products.index') }}" class="btn btn-success"> Ver más</a>
               </div>
               <div class="clearfix"></div>
          </div>
     </div>

     <h2>Bienvenido a la Tienda Virtual!</h2>
     <p>El lugar donde encontrarás gran variedad de productos a un buen precio!!</p>
     @include('partials.search')
     
     @include('partials.down-banners-2')
</div>
@endsection