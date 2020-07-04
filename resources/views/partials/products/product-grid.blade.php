<div class="row products">
    @foreach($products as $product)
    <div class="col-xs-12 col-md-6 col-lg-4">
        <div class="card product">
            <div class="card-header">
                <p class="product-name">{{ $product->name }}</p>
            </div>
            <div class="card-body">
                @if($product->image_path)
                <div class="photo-product">
                    <img src="{{ route('products.get-image',$product->image_path) }}" alt="">
                </div>
                @else
                <div class="photo-product">
                    <img src="https://previews.123rf.com/images/themoderncanvas/themoderncanvas1605/themoderncanvas160500008/56739040-dise%C3%B1o-de-iconos-de-productos-org%C3%A1nicos-s%C3%ADmbolo-del-producto-org%C3%A1nico-sello-de-producto-org%C3%A1nico-con-dise%C3%B1o-de-for.jpg" alt="Imagen por defecto">
                </div>
                @endif
                <hr>
                <div class="info-container">
                    <small>{{ $product->category != null ? $product->category->name : "Sin categoría" }}</small>
                    <strong class="currency">{{ $product->price }}</strong>
                </div>
                <button class="btn btn-primary d-block">Agregar al carrito</button>
            </div>
            <div class="card-footer">
                Ver más
            </div>
        </div>
    </div>
    @endforeach
</div>