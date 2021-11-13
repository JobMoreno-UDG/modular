@extends('layouts.plantilla')
@section('titulo', 'Historial - Paciente')
@section('content')
    <br>
    <div class="card w-100">
        <div class="card-body">
            @php($o = ['1' => 'Normal Alto', '2' => 'Normal', '3' => 'Leve Moderado', '4' => 'Severo'])
            @php($values = ['Orientación' => 'orientacion', 'Atención y Concentración' => 'atencion_concentracion', 'Memoria' => 'memoria', 'Funciones Ejecutivas' => 'funciones_ejecutivas', 'Lenguaje' => 'lenguaje', 'Precepción' => 'percepcion'])

            <p class="text-center">Primera Evaluacion</p>
            <div class="row text-left justify-content-between">
                @foreach ($values as $key => $node)
                    <div class="col-sm-12 col-md-4">
                        <p><b>{{ $key }} </b>{{ $o[$first->$node] }}</p>
                    </div>
                @endforeach
            </div>
            <br>

            <p class="text-center">Ultima Evaluacion</p>
            <div class="row text-left justify-content-between">
                @foreach ($values as $key => $node)
                    <div class="col-sm-12 col-md-4">
                        <p><b>{{ $key }} </b>{{ $o[$last->$node] }}</p>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="row">
                <div class=" table-responsive col-sm-12">
                    <table class="table w-100">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Enfocado</td>
                                <td>Nivel Cognitivo</td>
                                <td>Descripcion</td>
                                <td>Fecha de Registro</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($new_actividades as $key => $item)
                                <tr style="border:#000 solid 2px;">
                                    @foreach ($item as $llave => $valor)
                                    <tr>
                                        <td>{{ $valor->get('nombre') }}</td>
                                        <td>{{ $valor->get('especializa') }}</td>
                                        <td>{{ $o[$valor->get('grado')] }}</td>
                                        <td>{{ $valor->get('descripcion') }}</td>
                                        <td>{{ date('d-M-Y', strtotime($valor->get('0'))) }}</td>
                                    </tr>
                                    @endforeach
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-end">
        <div class="col-sm-12 col-md-3 col-xl-2">
            <a class="btn btn-dark w-100" href="{{ route('pacientes.show', ['id_doctor' => Auth::user()->id, 'paciente' => $paciente->id]) }}">Regresar</a>
        </div>
    </div>
    <br>
@endsection
