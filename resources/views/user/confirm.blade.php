@extends('layouts.app')
@section('title', 'Confirmado!')

@section('content')
<div class="container">
    <h1 class="text-center p-3">Confirmación exitosa!</h1>
    <p>Gracias {{ $user->name }} por confirmar tu correo, ahora puedes acceder a todos nuestros servicios</p>
    <a href="{{ route('login') }}">Ir al inicio de sección</a>
</div>
@endsection