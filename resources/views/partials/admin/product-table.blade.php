<table class="table table-border table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Código Alterno</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría</th>
            <th>Habilitado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->alt_code != null ? $product->alt_code : "Sin código"}}</td>
        <td>{{ $product->name }}</td>
        <td class="currency">{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->category != null ? $product->category->name : "Sin categoría" }}</td>
        @if($product->active)
        <td class="bg-success text-white text-center border border-white rounded">Si</td>
        @else
        <td class="bg-danger text-white text-center border border-white rounded">No</td>
        @endif
        <td class="d-flex justify-content-between">
            <a href="{{ route('admin.product.change-state', ['id' => $product->id, 'search' => $search] )  }}" class="btn btn-primary">
                {{$product->active ? 'Deshabilitar' : 'Habilitar' }}
            </a>
            <a href="#" class="btn btn-warning">
                <i class="fa fa-pencil"></i> Editar
            </a>
            <a href="#" class="btn btn-info">
                <i class="fa fa-eye"></i> Ver
            </a>
        </td>
    </tr>
    @endforeach
</table>