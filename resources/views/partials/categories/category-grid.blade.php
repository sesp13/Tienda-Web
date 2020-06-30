<div class="category-grid my-5">
    @foreach($categories as $category)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 d-xs-block d-lg-flex justify-content-between">
            <h2>{{ $category->name }}</h2>
            <p>Cantidad de productos disponibles: {{ count($category->products) }}</p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 d-block d-lg-flex justify-content-end">
            <a href="{{ route('products.get-by-categorie', $category->id ) }}" class="btn btn-primary">
                Ver productos
            </a>
        </div>
    </div>
    <hr>
    @endforeach
</div>
<div class="d-flex justify-content-end">
    {{ $categories->links() }}
</div>