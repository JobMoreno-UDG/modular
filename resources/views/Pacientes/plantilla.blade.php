@foreach ($pacientes as $item)
    <div class="card w-100 m-1">
        <div class="card-body">
            <h3 class="card-title"><b>Nombre </b>{{ $item->nombre }}</h3>
            <h5>
                <b class="card-text">Enfermedad </b>{{ $item->enfermedad }}
                <b class="card-text">Fecha Nacimiento </b>{{ $item->fecha_nacimiento }}
                <b class="card-text">Genero </b>{{ $item->genero == 'H' ? 'Hombre' : 'Mujer' }}
            </h5>
            <div class="row">
                <a class="btn btn-outline-dark col-sm-6 col-md-2 m-1"
                    href="{{ route('pacientes.show', ['id_doctor' => Auth::user()->id, 'paciente' => $item->id]) }}">Ver
                    más</a>
                <a href=" {{ route('pacientes.history', ['id_doctor' => Auth::user()->id, 'paciente' => $item->id]) }}"
                    class="btn btn-outline-primary col-sm-6 col-md-2  m-1">Ver Historial</a>
                <a class="btn btn-outline-success col-sm-6 col-md-2  m-1" href="{{ route('pacientes.edit', ['id_doctor' => Auth::user()->id, 'paciente' => $item->id]) }}">Editar</a>
                <a class="btn btn-outline-danger col-sm-6 col-md-2  m-1" href="">Eliminar</a>
            </div>

        </div>
    </div>
@endforeach
{!! $pacientes->links()!!}
@if ($pacientes->all() == Null)
<hr>
    <h2>No hay coincidencias</h2>
@endif
