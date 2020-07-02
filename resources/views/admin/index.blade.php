@extends('layouts.app')

@section('title', "Administrador")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center custom-class">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> Panel de Administrador
                    </h1>
                </div>
                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{ route('admin.users') }}">Usuarios de la plataforma</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories') }}">Categorías de la plataforma</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products') }}">Productos de la plataforma</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection