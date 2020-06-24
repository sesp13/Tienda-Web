@extends('layouts.app')

@section('title', "Usuarios-Búsqueda")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Resultados de Búsqueda</h1>
                </div>
                <div class="card-body">
                    <h2>Buscaste: {{ $search }}</h2>
                    @include('partials.message')
                    @if(count($users) > 0)
                    @include('partials.admin.user-table')
                    @else
                    <h3>No hay coincidencias</h3>
                    @endif
                </div>
                {{ $users->links() }}
                <div class="card-footer">
                    <a href="{{ route('admin.users') }}">Volver al panel de usuarios</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection