@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1 class="text-center">{{ $edit ? "Editar Producto" : "Crear Producto" }}</h1>
        </div>

        <div class="card-body">
          <form method="POST" action="{{ route($url) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="form-group row">
              <label for="alt_code" class="col-md-3 col-form-label text-md-right">Código Alterno</label>

              <div class="col-md-8">
                <input id="alt_code" type="text" class="form-control @error('alt_code') is-invalid @enderror" name="alt_code" value="{{ old('alt_code', $product->alt_code) }}" autocomplete="alt_code" autofocus>

                @error('alt_code')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="category_id" class="col-md-3 col-form-label text-md-right">Categoría</label>

              <div class="col-md-8">
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                  @endforeach
                </select>

                @error('category_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-md-3 col-form-label text-md-right">Nombre</label>

              <div class="col-md-8">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name ) }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>

              <div class="col-md-8">
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $product->description) }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="price" class="col-md-3 col-form-label text-md-right">Precio</label>

              <div class="col-md-8">
                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}" required autocomplete="price">

                @error('price')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>

              <div class="col-md-8">
                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" autocomplete="image_path">

                @error('image_path')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            @if($product->image_path)
            <div class="row  my-3">
              <div class="col-md-3"></div>
              <div class="col-md-8 photo-product">
                <img src="{{ route('products.get-image',$product->image_path) }}" alt="Imagen del producto">
              </div>
            </div>
            @endif

            <div class="form-group row">
              <label for="stock" class="col-md-3 col-form-label text-md-right">stock</label>

              <div class="col-md-8">
                <input id="stock" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $product->stock) }}" required>

                @error('stock')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="stock" class="col-md-3 col-form-label text-md-right">Habilitado</label>

              <div class="col-md-8">
                <select name="active" id="active" class="form-control @error('active') is-invalid @enderror" name="active">
                  <option value="1">Si</option>
                  <option value="0">No</option>
                </select>
                @error('active')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-3">
                <button type="submit" class="btn btn-primary">
                  {{ $edit ? "Editar Producto" : "Guardar producto"}}
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer">
          <a href="{{ route('admin.products') }}">Volver al panel de productos</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection