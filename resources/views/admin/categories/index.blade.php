@extends('layouts.app')

@section('title', "Categorías")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Categorías de la plataforma</h1>
                </div>
                <div class="card-body">
                    @include('partials.search')
                    @include('partials.message')
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Crear nueva categoría</a>
                    @include('partials.admin.category-table')
                </div>
                <div class="justify-content-center d-flex">
                    {{ $categories->links() }}
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.index') }}">Volver al panel de administrador</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>

@endsection