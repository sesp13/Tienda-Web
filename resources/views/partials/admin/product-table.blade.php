<table class="table table-border table-striped p-table">
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
        <td class="p-table-buttons">
            <a href="{{ route('admin.product.change-state', ['id' => $product->id, 'search' => $search] )  }}" class="btn btn-primary">
                {{$product->active ? 'Deshabilitar' : 'Habilitar' }}
            </a>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                <i class="fa fa-pencil"></i> Editar
            </a>
            <a href="{{ route('products.show',$product->id) }}" class="btn btn-info">
                <i class="fa fa-eye"></i> Ver
            </a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalProductDelete-{{ $product->id }}">
                Eliminar
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalProductDelete-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ¿Estás seguro?
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            El producto {{ $product->name }} se borrará y no podrá recuperarse
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                            <a href="{{ route('admin.products.delete', $product->id) }}" class="btn btn-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
</table>