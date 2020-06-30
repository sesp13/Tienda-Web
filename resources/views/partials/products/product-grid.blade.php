<div class="row products">
    @foreach($products as $product)
    <div class="col-xs-12 col-md-6 col-lg-4">
        <div class="card product">
            <div class="card-header">
                <p class="product-name">{{ $product->name }}</p>
            </div>
            <div class="card-body">
                <div class="photo-product">
                    <img src="https://www.pulsovideojuegos.com/wp-content/uploads/2020/01/super-mario-bros-3.jpg" alt="">
                </div>
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