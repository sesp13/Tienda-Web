@extends('layouts.app')

@section('title', "Administrador")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center custom-class">Panel de Administrador</h1>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.users') }}">Usuarios de la plataforma</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection