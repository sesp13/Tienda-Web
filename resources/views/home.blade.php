@extends('layouts.app')

@section('content')
<div class="container">
     <div class="web-title row">Tienda Web de SESP13</div>
     <div class="row my-3">
          <div class="col-12 d-block">
               <h1 class="main-banner">Últimos productos</h1>
               @include('partials.products.product-grid')
          </div>
     </div>

     <h2>Bienvenido a la Tienda Virtual!</h2>
     <p>El lugar donde encontrarás gran variadad de productos a un buen precio!!</p>

     <!-- Button trigger modal -->
     <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2">
          Launch demo modal
     </button> -->

     <!-- Modal -->
     <!-- <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Modal 2</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <div class="modal-body">
                         ...
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
               </div>
          </div>
     </div> -->
     @include('partials.down-banners-2')
</div>
@endsection