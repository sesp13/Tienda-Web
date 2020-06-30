<?php
/*
        Se requiere
         $searchMessage Mensaje del buscador
         $searchUrl  Nombre de la ruta por POST a consultar
    */
?>
<form  action="{{ route($searchUrl) }}" method="POST">
    @csrf
        <div class="form-group">
            <label for="search" class="form-label">{{ $searchMessage }}</label>
            <input type="text" class="form-control" required name="search" id="search">
        </div>
        <input type="submit" class="btn btn-primary" value="Buscar">
</form>