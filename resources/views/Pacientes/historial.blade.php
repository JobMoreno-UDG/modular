<?php
$fecha = new DateTime($paciente->fecha_nacimiento);
$hoy = new DateTime();
$edad = $hoy->diff($fecha);
?>
@extends('layouts.plantilla')
@section('titulo', 'Historial - Paciente')
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
                    <h5><b>Edad</b> {{ $edad->y }}</h5>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h5><b>Fecha Nacimiento</b> {{ $paciente->fecha_nacimiento }}</h5>
                </div>
                <div class="col-auto">
                    <h5><b>Genero</b> {{ $paciente->genero == 'H' ? 'Hombre' : 'Mujer' }}</h5>
                </div>
                <div class="col-auto">
                    <h5><b>Enfermedad </b>{{ $paciente->enfermedad }}</h5>
                </div>
                <div class="col-auto">
                    <h5><b>Escolaridad </b>{{ $paciente->escolaridad }}</h5>
                </div>
            </div>

            <hr>

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

            <hr>
            @php($o = ['1' => 'Normal Alto', '2' => 'Normal', '3' => 'Leve Moderado', '4' => 'Severo'])
            @php($values = ['Orientación' => 'orientacion', 'Atención y Concentración' => 'atencion_concentracion', 'Memoria' => 'memoria', 'Funciones Ejecutivas' => 'funciones_ejecutivas', 'Lenguaje' => 'lenguaje', 'Precepción' => 'percepcion'])

            <h5 class="text-center">Primera Evaluacion</h5>
            <div class="row text-left justify-content-between">
                @foreach ($values as $key => $node)
                    <div class="col-sm-12 col-md-4">
                        <h5><b>{{ $key }} </b>{{ $o[$first->$node] }}</h5>
                    </div>
                @endforeach
            </div>
            <br>

            <h5 class="text-center">Ultima Evaluacion</h5>
            <div class="row text-left justify-content-between">
                @foreach ($values as $key => $node)
                    <div class="col-sm-12 col-md-4">
                        <h5><b>{{ $key }} </b>{{ $o[$last->$node] }}</h5>
                    </div>
                @endforeach
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-12">
                    @foreach ($actividades as $key=> $item)
                        {{$key}}
                        {{$item}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
