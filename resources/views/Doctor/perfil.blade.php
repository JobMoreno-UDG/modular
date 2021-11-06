@extends('layouts.plantilla')
@section('titulo', 'Perfil')
@section('content')
    <br>
    <h1>Perfil de usuario</h1>
    <hr>
    <h2> <b>Nombre</b> {{ $user->name }}</h2>
    <h2> <b>Correo</b> {{ $user->email }}</h2>
@endsection
