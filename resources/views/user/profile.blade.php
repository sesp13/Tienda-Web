@extends('layouts.app')

@section('title', "Perfil")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Mi perfil</h1>
                </div>
                <div class="card-body">
                    <h2>Hola! {{ $user->name }} {{ $user->surname }} </h2>
                    <p>¿Qué deseas hacer hoy?</p>
                    <a href="{{ route('user.edit', $user->id) }}">Editar mis datos personales</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection