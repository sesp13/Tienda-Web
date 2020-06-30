<?php
/*
        Se requiere
         $searchMessage Mensaje del buscador
         $searchUrl  Nombre de la ruta por POST a consultar
    */
?>
<form class="row container d-flex justify-content-center mb-3" action="{{ route($searchUrl) }}" method="POST">
    @csrf
        <label for="search" class="form-label text-center d-inline col-xs-12 col-md-2">
        <i class="fa fa-search" aria-hidden="true"></i> {{ $searchMessage }}
        </label>
        <input type="text" class="form-control col-xs-12 col-md-7" required name="search" id="search">
        <input type="submit" class="btn btn-primary col-xs-12 ml-md-2 col-md-2 mt-sm-2 mt-md-0" value="Buscar">
</form>