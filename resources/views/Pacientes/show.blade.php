<?php
    $fecha = new DateTime($paciente->fecha_nacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha);
?>
@extends('layouts.plantilla')
@section('titulo', 'Mostrar - Paciente')
@section('content')
    <br>
    <div class="card w-100">
        <div class="card-body">
            <h5 class="text-center">Datos Generales</h5>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h5><b>Nombre</b> {{ $paciente->nombre }}</h5>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h5><b>Edad</b> {{$edad->y}}</h5>
                </div>
            </div> 
            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-4">
                    <h5><b>Fecha Nacimiento</b> {{ $paciente->fecha_nacimiento }}</h5>
                </div>
                <div class="col-sm-12 col-md-2">
                    <h5><b>Genero</b> {{ $paciente->genero == 'H' ? 'Hombre' : 'Mujer' }}</h5>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h5><b>Enfermedad </b>{{ $paciente->enfermedad }}</h5>
                </div>
                <div class="col-sm-12 col-md-3">
                    <h5><b>Escolaridad </b>{{ $paciente->escolaridad }}</h5>
                </div>
            </div>
            <hr />
            @php($o = ['1' => 'Normal Alto', '2' => 'Normal', '3' => 'Leve Moderado', '4' => 'Severo'])
            @php($values = ['Orientación' => 'orientacion', 'Atención y Concentración' => 'atencion_concentracion', 'Memoria' => 'memoria', 'Funciones Ejecutivas' => 'funciones_ejecutivas', 'Lenguaje' => 'lenguaje', 'Precepción' => 'percepcion'])
            <h5 class="text-center">Procesos Cognitivos</h5><br>
            <div class="row text-left justify-content-between">
                @foreach ($values as $key => $node)
                <div class="col-sm-12 col-md-4">
                    <h5><b>{{ $key }} </b>{{ $o[$cognicion->$node] }}</h5>
                </div>
            @endforeach
            </div>
            <hr />
            <h5 class="text-center">Otras Enfermedades<br /></h5>
            <div class="row">
                <div class="col-auto">
                    @if ($paciente->enfermedades != ' ' && $paciente->enfermedades != '')
                        <ul>
                            <h5>
                                @foreach (explode(',', $paciente->enfermedades) as $item)
                                    <li> {{ $item }} </li>
                                @endforeach
                            </h5>
                        </ul>
                    @else
                        <h5>No padece de otras enfermedades</h5>
                    @endif
                </div>
            </div>
            <hr />
            <h5 class="text-center">Actividades<br /></h5>
            <div class="row">
                <div class="col-auto">
                    @if ($activity->all() == null)

                        <h5>Ninguna Asignada</h5>
                    @else
                        <ul>
                            @foreach ($activity as $key => $item)
                                @foreach ($item as $value)
                                    @if ($value->all() != null)
                                        @foreach ($value as  $end)
                                            <li>
                                                <b>Nombre</b> {{ $end->nombre }} <br>
                                                <b>Área Enfocada</b> {{$end->especializa}} 
                                                <b>Nivel Cognitivo</b> {{$o[$end->grado]}} <br>
                                                <b>Descripción</b> {{$end->descripcion}} 
                                            </li>
                                            <hr>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center">Recomendaciones</h5>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('pacientes.activity', ['id_doctor' => Auth::user()->id, 'paciente' => $paciente->id]) }}"
                        class="btn btn-primary col-sm-12 col-md-2 m-1">Editar Actividades</a>
                    <a href="" class="btn btn-success col-sm-12 col-md-2 m-1">Actualizar Estado</a>
                    <a href="{{ route('pacientes.history', ['id_doctor' => Auth::user()->id, 'paciente' => $paciente->id]) }}"
                        class="btn btn-dark col-sm-12 col-md-2 m-1">Ver Historial</a>
                </div>

            </div>
        </div>
    </div>
@endsection
