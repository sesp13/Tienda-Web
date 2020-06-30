<table class="table table-border table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Cantidad de productos asociados</th>
            <th>Acciones</th>
        </tr>
    </thead>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->name }}</td>
        <td>{{ count($category->products) }}</td>
        <td>
            <a href="#" class="btn btn-warning">Editar</a>
            <a href="#" class="btn btn-danger">Eliminar</a>
        </td>
    </tr>
    @endforeach
</table>