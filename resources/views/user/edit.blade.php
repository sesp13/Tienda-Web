@extends('layouts.app')
@section('title','Editar Usuario')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Te puede interesar
                </div>
                <div class="card-body">
                    <ul>
                        @if($admin)
                        <li> 
                            <a href="{{ route('admin.users') }}">[Admin] Panel de usuarios</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('user.profile') }}">Mi perfil</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2>Editar Usuario</h2>
                </div>
                <div class="card-body">
                    @include('partials.message')
                    @include('partials.user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection