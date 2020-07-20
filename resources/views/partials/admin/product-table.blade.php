<?php 
    /*
        Se requiere
        $products: array de productos
    */
?> 
<table class="table table-border table-striped p-table">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th class="text-left">Precio</th>
            <th>Stock</th>
            <th class="text-left">Categoría</th>
            <th>Habilitado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    @foreach($products as $product)
    <tr>
        <td class="text-center">{{ $product->id }}</td>
        <td class="cast-title-table">{{ $product->name }}</td>
        <td class="currency">{{ $product->price }}</td>
        <td class="text-center">{{ $product->stock }}</td>
        <td>{{ $product->category != null ? $product->category->name : "Sin categoría" }}</td>
        @if($product->active)
        <td class="bg-success text-white text-center border border-white rounded">Si</td>
        @else
        <td class="bg-danger text-white text-center border border-white rounded">No</td>
        @endif
        <td class="p-table-buttons">
            @if($tableComplex)
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                <i class="fa fa-pencil"></i> Editar
            </a>
            @endif
            <!-- Modal de información -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalProductView-{{ $product->id }}">
                <i class="fa fa-eye"></i> Ver Detalles
            </button>

            <div class="modal fade" id="modalProductView-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Detalles de {{ $product->name }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 container">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>
                                                <strong>Código alterno: </strong> {{ $product->alt_code != null ? $product->alt_code : "Sin código"}}
                                            </p>
                                            <hr>
                                            <p>
                                                <strong>Stock: </strong> {{ $product->stock }}
                                            </p>
                                            <hr>
                                            <strong>Descripción</strong>
                                            <p>{{ $product->description }}</p>
                                            <hr>
                                            <strong>Imagen</strong>
                                            @if($product->image_path)
                                            <div class="photo-product">
                                                <img src="{{ route('products.get-image',$product->image_path) }}" alt="Imagen de producto">
                                            </div>
                                            @else
                                            <div class="photo-product">
                                                <img src="https://previews.123rf.com/images/themoderncanvas/themoderncanvas1605/themoderncanvas160500008/56739040-dise%C3%B1o-de-iconos-de-productos-org%C3%A1nicos-s%C3%ADmbolo-del-producto-org%C3%A1nico-sello-de-producto-org%C3%A1nico-con-dise%C3%B1o-de-for.jpg" alt="Imagen de producto">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('admin.product.change-state', ['id' => $product->id, 'search' => $search] )  }}" class="btn btn-primary">
                                {{$product->active ? 'Deshabilitar producto' : 'Habilitar producto' }}
                            </a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            @if($tableComplex)
            <!-- Modal de eliminación -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalProductDelete-{{ $product->id }}">
                <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
            </button>

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
            @endif
        </td>
    </tr>
    @endforeach
</table>