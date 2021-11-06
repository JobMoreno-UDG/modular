@extends('layouts.plantilla')
@section('titulo', 'Pacientes')
@section('content')
    <br />
    <div class="row justify-content-between">
        <div class="col-auto">
            <form class="row" action="" method="post">
                @csrf
                <div class="col-sm-12 col-md-5">
                    <input class="form-control" type="text" placeholder="Buscar">
                </div>
                <div class="col-sm-12 col-md-4">
                    <select class="form-control" name="" id="">
                        <option value="">Nombre</option>
                        <option value="">Enfermedad</option>
                        <option value="">Genero</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-3">
                    <button type="submit" class="btn btn-dark col-12">Buscar</button>
                </div>
            </form>
        </div>
        <div class="col-auto">
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{route('pacientes.create',Auth::user()->id)}}" class="btn btn-outline-dark">Registrar Paciente</a>
                </div>
                
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        @foreach ($pacientes as $item)
            <div class="card w-100">
                <div class="card-body">
                    <h3 class="card-title"><b>Nombre </b>{{ $item->nombre }}</h3>
                    <h5 class="card-text">
                        <b>Enfermedad </b>{{ $item->enfermedad }}
                        <b>Fecha Nacimiento </b>{{ $item->fecha_nacimiento }}
                        <b>Genero </b>{{ $item->genero == 'H' ? 'Hombre' : 'Mujer' }}
                    </h5>
                    <div class="row">
                        <a class="btn btn-outline-dark col-sm-6 col-md-2 m-1" href="{{ route('pacientes.show',['id_doctor'=>Auth::user()->id,'paciente'=> $item->id]) }}">Ver más</a>
                        <a href=" {{ route('pacientes.history',['id_doctor'=>Auth::user()->id,'paciente'=> $item->id]) }}" class="btn btn-outline-primary col-sm-6 col-md-2  m-1">Ver Historial</a>
                        <a class="btn btn-outline-success col-sm-6 col-md-2  m-1" href="">Editar</a>
                        <a class="btn btn-outline-danger col-sm-6 col-md-2  m-1" href="">Eliminar</a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    
@endsection
