@extends('layouts.app')
@section('title', 'Confirmado!')

@section('content')
    <h1 class="text-center p-3">Confirmación exitosa!</h1>
    <p>Gracias {{ $user->name }} por iniciar sesión en la plataforma</p>
    <a href="{{ route('login') }}">Ir al inicio de sección</a>
@endsection