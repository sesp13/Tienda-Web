@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">{{ $edit ? "Actualizar categoría" : "Crear nueva categoría"  }}</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route($postUrl) }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}" readonly>

                        <div class="form-group">
                            <label for="name">Nombre</label>


                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('nit',$category->name) }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>


                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success">
                                {{ $edit ? "Editar" : "Crear" }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.categories') }}">Volver al panel de categorías</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection