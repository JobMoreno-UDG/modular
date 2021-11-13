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
            <p class="text-center">Datos Generales</p>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <p><b>Nombre</b> {{ $paciente->nombre }}</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <p><b>Edad</b> {{$edad->y}}</p>
                </div>
            </div> 
            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-4">
                    <p><b>Fecha Nacimiento</b> {{ $paciente->fecha_nacimiento }}</p>
                </div>
                <div class="col-sm-12 col-md-2">
                    <p><b>Genero</b> {{ $paciente->genero == 'H' ? 'Hombre' : 'Mujer' }}</p>
                </div>
                <div class="col-sm-12 col-md-3">
                    <p><b>Enfermedad </b>{{ $paciente->enfermedad }}</p>
                </div>
                <div class="col-sm-12 col-md-3">
                    <p><b>Escolaridad </b>{{ $paciente->escolaridad }}</p>
                </div>
            </div>
            <hr />
            @php($o = ['1' => 'Normal Alto', '2' => 'Normal', '3' => 'Leve Moderado', '4' => 'Severo'])
            @php($values = ['Orientación' => 'orientacion', 'Atención y Concentración' => 'atencion_concentracion', 'Memoria' => 'memoria', 'Funciones Ejecutivas' => 'funciones_ejecutivas', 'Lenguaje' => 'lenguaje', 'Precepción' => 'percepcion'])
            <p class="text-center">Procesos Cognitivos</p><br>
            <div class="row text-left justify-content-between">
                @foreach ($values as $key => $node)
                <div class="col-sm-12 col-md-4">
                    <p><b>{{ $key }} </b>{{ $o[$cognicion->$node] }}</p>
                </div>
            @endforeach
            </div>
            <hr />
            <p class="text-center">Otras Enfermedades<br /></p>
            <div class="row">
                <div class="col-auto">
                    @if ($paciente->enfermedades != ' ' && $paciente->enfermedades != '')
                        <ul>
                            <p>
                                @foreach (explode(',', $paciente->enfermedades) as $item)
                                    <li> {{ $item }} </li>
                                @endforeach
                            </p>
                        </ul>
                    @else
                        <p>No padece de otras enfermedades</p>
                    @endif
                </div>
            </div>
            <hr />
            <p class="text-center">Actividades<br /></p>
            <div class="row">
                <div class="col-auto">
                    @if ($activity->all() == null)

                        <p>Ninguna Asignada</p>
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
                    <p class="text-center">Recomendaciones</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-end">
        <div class="col-sm-12 ">
            <a href="{{ route('pacientes.activity', ['id_doctor' => Auth::user()->id, 'paciente' => $paciente->id]) }}"
                class="btn btn-primary col-sm-12 col-md-3 col-xl-2 m-1">Editar Actividades</a>
                
            <a href="" class="btn btn-success col-sm-12 col-md-3  col-xl-2 m-1">Actualizar Estado</a>

            <a href="{{ route('pacientes.history', ['id_doctor' => Auth::user()->id, 'paciente' => $paciente->id]) }}"
                class="btn btn-dark col-sm-12 col-md-3 col-xl-2 m-1">Ver Historial</a>
        </div>
    </div>
    <br>
@endsection
