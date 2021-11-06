@extends('layouts.plantilla')
@section('titulo', 'Resgitro - Pacientes')

@section('content')
    <br>
    <h3>Datos Generales</h3>
    <form action="{{ route('pacientes.store', Auth::user()->id) }}" method="post">
        @csrf
        <div class="row justify-content-between">
            <div class="col-12">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" />
            </div>

            <div class="col-sm- 12 col-md-3">
                <label class="form-label">Fecha Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" />
            </div>
            <div class="col-sm- 12 col-md-3">
                <label class="form-label">Genero</label>
                <select class="form-control" name="genero" id="">
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label class="form-label">Grado Escolar</label>
                <select class="form-control" name="escolaridad" id="">
                    <option value="Sin estudios">Sin Estidudios</option>
                    <option value="Primaria">Primaria</option>
                    <option value="Secundaria">Secundaria</option>
                    <option value="Preparatoria">Preparatoria</option>
                    <option value="Universsidad">Universidad</option>
                    <option value="Posgrado">Posgrado</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label class="form-label" for="enfermedad">Enfermedad Padecida</label>
                <input class="form-control" type="text" name="enfermedad">
            </div>
        </div>

        <hr />

        <h3>Procesos Cognitivos</h3>
        <div class="row">
            <div class="col-sm- 12 col-md-3">
                <label for="orientacion" class="form-label">Orientación</label>
                <select class="form-control" name="orientacion" id="orientacion">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>

            <div class="col-sm- 12 col-md-3">
                <label for="atencion_concentarcion" class="form-label">Atención y Concentración</label>
                <select class="form-control" name="atencion_concentarcion" id="atencion_concentarcion">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>

            <div class="col-sm- 12 col-md-3">
                <label for="memoria" class="form-label">Memoria</label>
                <select class="form-control" name="memoria" id="memoria">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label for="f_ejecutivas" class="form-label">Funciones Ejecutivas</label>
                <select class="form-control" name="f_ejecutivas" id="f_ejecutivas">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label for="lenguaje" class="form-label">Lenguaje</label>
                <select class="form-control" name="lenguaje" id="lenguaje">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>
            <div class="col-sm- 12 col-md-3">
                <label for="percepcion" class="form-label">Percepción</label>
                <select class="form-control" name="percepcion" id="percepcion">
                    <option value="1">Normal Alto</option>
                    <option value="2">Normal</option>
                    <option value="3">Leve Moderado</option>
                    <option value="4">Severo</option>
                </select>
            </div>
        </div>

        <hr />

        <h3>Otras Enfermedades</h3>

        <div id="formulario">
            <button type="button" class="clonar btn btn-secondary btn-sm">+</button>
            <label for="enfermedades">Agregar Enfermedad</label>
            
            <div class="input-group">
                <input type="text" class="form-control col-md-6" name="enfermedades[]"
                    placeholder="Nombre Enfermedad" id="enfermedades">
                    <br>
            </div>
        </div>
        <br />

        <button class="btn btn-success col-sm- 12 col-md-3" type="submit">Registrar</button>
    </form>
    <br>
    <script>
        $('.clonar').click(function() {
  // Clona el .input-group
  var $clone = $('#formulario .input-group').last().clone();

  // Borra los valores de los inputs clonados
  $clone.find(':input').each(function () {
    if ($(this).is('select')) {
      this.selectedIndex = 0;
    } else {
      this.value = '';
    }
  });

  // Agrega lo clonado al final del #formulario
  $clone.appendTo('#formulario');
});
    </script>
@endsection
