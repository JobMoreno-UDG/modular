@extends('layouts.plantilla')
@section('titulo','Resgitro - Pacientes')
@section('content')
<form action="" method="post">
    @csrf
    <div class="col-auto">
        <label class="form-label">Nombre</label>
        <input type="text"class="form-control"/>
    </div>
    <div class="col-auto">
        <label class="form-label">Fecha Nacimiento</label>
        <input type="date" class="form-control"/>
    </div>
    <div class="col-auto">
        <label class="form-label">Genero</label>
        <select class="form-control" name="" id="">
            <option value="0">Hombre</option>
            <option value="1">Mujer</option>
        </select>
    </div>
    <div class="col-auto">
        <label class="form-label">Grado Escolar</label>
        <select class="form-control" name="" id="">
            <option value="Sin estudios">Sin Estiduudios</option>
            <option value="Primaria">Primaria</option>
            <option value="Secundaria">Secundaria</option>
            <option value="Preparatoria">Preparatoria</option>
            <option value="Universsidad">Universidad</option>
            <option value="Posgrado">Posgrado</option>
        </select>
    </div>
     
</form>
@endsection