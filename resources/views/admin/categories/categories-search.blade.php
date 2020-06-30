@extends('layouts.app')

@section('title', "Resultados de búsqueda")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Resultados de bísqueda</h1>
                </div>
                <div class="card-body">
                    <h2>Buscaste: {{ $search }}</h2>
                    @include('partials.message')
                    @if(count($categories) > 0)
                    @include('partials.admin.category-table')
                    @else
                    <h3>No hay coincidencias</h3>
                    @endif
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