<!-- Variables requeridas para el reporte
    users
    sectionTitle
    pageTitle
 -->
@extends('layouts.app')

@section('title', $sectionTitle)

@section('content')

<!-- Esta variable se sete así por el comportamiento de la tabla -->
{{ $search = '' }}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">{{ $pageTitle }}</h1>
                </div>
                <div class="card-body">
                    @include('partials.message')
                    @if(count($users) > 0)
                    @include('partials.admin.user-table')
                    @else
                    <h3>De momento no hay usuarios que cumplan este criterio</h3>
                    @endif
                </div>
                <div class="justify-content-center d-flex">
                    {{ $users->links() }}
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.users') }}">Volver al panel de usuarios</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection