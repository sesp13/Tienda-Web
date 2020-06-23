@extends('layouts.app')

@section('title', "Usuarios")

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Usuarios de la plataforma</h1>
                </div>
                <div class="card-body">
                    @include('partials.message')
                    <table class="table table-border table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nit</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Habilitado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->nit }}</td>
                            <td>{{ $user->name .' '. $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            @if($user->active)
                            <td class="bg-success text-white text-center border border-white rounded">Si</td>
                            @else
                            <td class="bg-danger text-white text-center border border-white rounded">No</td>
                            @endif
                            <td>
                                <a href="{{ route('admin.change-state', $user->id) }}" class="btn btn-primary">
                                    {{$user->active ? 'Deshabilitar' : 'Habilitar' }}
                                </a>
                                <a href="{{ route('user.edit',$user->id) }}" class="btn btn-warning ml-2">Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@endsection