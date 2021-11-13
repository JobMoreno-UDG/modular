@extends('layouts.plantilla')
@section('titulo', 'Pacientes')
@section('content')
    <br />
    <div class="row justify-content-between">
        <form class="row col-md-8 col-sm-12" id="form-busqueda" action="">
            @csrf
            <div class="col-sm-12 col-md-5">
                <select class="form-control" name="buscar_por" id="buscar_por" onChange="cambio()">
                    <option value="buscar_por" selected>Buscar por</option>
                    <option value="nombre">Nombre</option>
                    <option value="genero">Genero</option>
                    <option value="escolaridad">Escolaridad</option>
                    <option value="enfermedad">Enfermedad</option>
                </select>
                @error('buscar_por')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-6" id='valor'>
                <!-- Se agregan los campos aqui-->
            </div>
        </form>
        <div class="row col-sm-12  col-md-4 order-sm-first order-md-last">
            <div class="col-sm-12 justify-content-end">
                <a href="{{ route('pacientes.create', Auth::user()->id) }}" class="btn btn-outline-dark w-100 ">Registrar
                    Paciente</a>
            </div>
        </div>
    </div>
    <br />
    <div class="row" id="container">
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);

            });

            function fetch_data(page) {
                $.ajax({
                    method: 'POST',
                    data: $('#form-busqueda').serialize(),
                    url: "{{ route('pacientes.search', ['id_doctor' => Auth::user()->id]) }}" + "?page=" +
                        page,
                    success: function(data) {
                        $('#container').html(data);
                    }
                });
            }
        });

        function logKey() {
            let search_of = $('#buscar_por').val();
            let search = $('#buscar').val();
            $.ajax({
                url: "{{ route('pacientes.search', ['id_doctor' => Auth::user()->id]) }}",
                method: 'POST',
                data: $('#form-busqueda').serialize()

            }).done(function(data) {
                $('#container').html(data);
            });

        }

        function cambio() {
            let valor = document.getElementById("buscar_por");
            let area = document.getElementById("valor");
            if (area.hasChildNodes()) {
                area.removeChild(area.lastChild);
            }
            if (valor.value == "nombre" || valor.value == "enfermedad") {
                var input = document.createElement("input");
                input.type = "text";
                input.name = 'buscar';
                input.placeholder = 'Introduce para buscar';
                input.className = "form-control";
                input.setAttribute("id", 'buscar')
                input.addEventListener('keyup', logKey);
                area.appendChild(input);

            } else if (valor.value == "escolaridad") {
                let select = document.createElement("select");
                select.name = 'buscar';
                select.className = 'form-control';
                let opciones = ['- - -', 'Sin Estudios', 'Primaria', 'Secundaria', 'Preparatoria',
                    'Universidad', 'Posgrado'
                ];
                let valores = ['', 'Sin Estudios', 'Primaria', 'Secundaria', 'Preparatoria', 'Universidad',
                    'Posgrado'
                ];
                for (var i = 0; i < opciones.length; i++) {
                    let option = document.createElement("option");
                    option.text = opciones[i];
                    option.value = valores[i];
                    select.add(option);
                }
                select.setAttribute("id", 'buscar')
                select.addEventListener('change', logKey);
                area.appendChild(select);

            } else if (valor.value == "genero") {
                let select = document.createElement("select");
                select.name = 'buscar';
                select.className = 'form-control';
                let opciones = ['- - -', 'Hombre', 'Mujer'];
                let valores = ['', 'H', 'M'];
                for (var i = 0; i < opciones.length; i++) {
                    let option = document.createElement("option");
                    option.text = opciones[i];
                    option.value = valores[i];
                    select.add(option);
                }
                select.setAttribute("id", 'buscar')
                select.addEventListener('change', logKey);
                area.appendChild(select);
            }
        }
    </script>
@endsection
