@extends('layouts.plantilla')
@section('titulo','Pacientes')
@section('content')
<br/>
<div class="row justify-content-end">
    <a class="btn btn-primary" href="{{route('pacientes.registro')}}">Registrar Paciente</a>
</div>
<br/>
<div class="row">
<table class="table">
    <tr>
        <td>Nombre</td>
        <td>Genero</td>
        <td>Fecha Nacimiento</td>
        <td>Nivel Cognitivo</td>
        <td>Ver más</td>
        <td>Editar</td>
        <td>Eliminar</td>
    </tr>
    @foreach ($pacientes as $item)
        <tr>
            <td>{{$item->nombre}}</td>
            <td>{{$item->nombre}}</td>
            <td>{{$item->nombre}}</td>
            <td>{{$item->nombre}}</td>
            <td>{{$item->nombre}}</td>
            <td>{{$item->nombre}}</td>
            <td>{{$item->nombre}}</td>
        </tr>
    @endforeach
</table>
</div>
@endsection