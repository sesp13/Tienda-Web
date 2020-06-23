@extends('layouts.app')
@section('title','Editar Usuario')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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