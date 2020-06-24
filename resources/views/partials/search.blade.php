<form class="form-inline justify-content-end mb-3" action="{{ route($searchUrl) }}" method="POST">
    @csrf
    <div class="form-group col-10">
        <label for="search" class="form-label col-4">Buscar usuarios</label>
        <input type="text" class="form-control col-8" required name="search" id="search">
    </div>
    <div class="form-group col-2">
        <input type="submit" class="btn btn-primary" value="Buscar">
    </div>
</form>