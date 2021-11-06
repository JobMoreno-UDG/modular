@extends('layouts.plantilla')
@section('titulo', 'Actividades')
@section('content')
    <br>
    <div class="row">
        <form class="row ">
            @csrf
            <div class="col-sm-12 col-md-2">
                <select class="form-control" name="buscar_por" id="buscar_por" onChange="cambio()">
                    <option value="buscar_por">Buscar por</option>
                    <option value="nombre">Nombre</option>
                    <option value="especializa">Área Especialización</option>
                    <option value="grado">Nivel de Cognición</option>
                </select>
                @error('buscar_por')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-3" id='valor'>
                <!-- Se agregan los campos aqui-->
            </div>
        </form>
    </div>
    <br>
    <div class="card-list" id="card-list">
        <div class="row justify-content-between">
            <div class="col-sm-12 col-md-8">
                <h3>Actividades</h3>
                <hr>
                @php($o = ['1' => 'Normal Alto', '2' => 'Normal', '3' => 'Leve Moderado', '4' => 'Severo'])
                @foreach ($actividades as $item)
                    <div class="card m-1">
                        <div class="card-body">
                            <span class="card-text nombre"><b>Nombre </b> {{ $item->nombre }}</span> <br>
                            <span class="card-text area">Área Especializada {{ $item->especializa }}</span>
                            <span class="card-text nivel">Nivel de Cognición {{ $o[$item->grado] }}</span> <br>
                            <span class="card-text">Descripción {{ $item->descripcion }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-12  col-md-4 ">
                <form class="row sticky-md-top" action="{{ route('actividades.registro', Auth::user()->id) }}" method="post">
                    <h3 class="text-center">Añadir Actividad</h3>
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="" placeholder="Nombre">
                        @error('nombre')
                            <div class="alert alert-sm alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="area">Area Enfocada</label>
                        <select class="form-control" name="area" id="">
                            <option value="Orientacion">Orientación</option>
                            <option value="Atención y Concentración">Atención y Concentración</option>
                            <option value="Memoria">Memoria</option>
                            <option value="Funciones Ejecutivas">Funciones Ejecutivas</option>
                            <option value="Lenguaje">Lenguaje</option>
                            <option value="Percepcion">Percepción</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="nivel">Nivel de Cognición</label>
                        <select class="form-control" name="nivel" id="">
                            <option value="1">Normal Alto</option>
                            <option value="2">Normal</option>
                            <option value="3">Leve Moderada</option>
                            <option value="4">Severo</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <br>
                        <textarea name="descripcion" class="form-control" placeholder="Descripción"></textarea>
                        @error('descripcion')
                            <div class="alert alert-sm alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <br>
                        <button class="btn btn-success col-12" type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{$actividades->links()}}
    <script>
        function logKey() {
            let input_search = document.getElementById('buscar_por').value;
            var input = document.getElementById('buscar').value;
            //console.log(input);
            var cardConatiner = document.getElementById('card-list');
            //console.log(card);
            var card = document.getElementsByClassName('card');
            //console.log(card);
            if (input_search == 'nombre') {
                for (var i = 0; i < card.length; i++) {
                    let text = card[i].querySelector('.card-body .nombre');
                    //console.log(text);
                    if (text.innerText.indexOf(input)> -1 ) {
                        card[i].style.display = '';
                    }else{
                        card[i].style.display = 'none';
                    }
                }
            }
            else if(input_search == 'especializa'){
                for (var i = 0; i < card.length; i++) {
                    let text = card[i].querySelector('.card-body .area');
                    //console.log(text);
                    if (text.innerText.indexOf(input)> -1 ) {
                        card[i].style.display = '';
                    }else{
                        card[i].style.display = 'none';
                    }
                }
            }


        }

        function cambio() {
            let valor = document.getElementById("buscar_por");
            let area = document.getElementById("valor");
            if (area.hasChildNodes()) {
                area.removeChild(area.lastChild);
            }
            if (valor.value == 'buscar_por') {}
            if (valor.value == "nombre") {
                var input = document.createElement("input");
                input.type = "text";
                input.name = 'buscar';
                input.placeholder = 'Nombre';
                input.className = "form-control";
                input.setAttribute("id", 'buscar')
                input.addEventListener('keyup', logKey);
                area.appendChild(input);

            } else if (valor.value == "especializa") {
                let select = document.createElement("select");
                select.name = 'buscar';
                select.className = 'form-control';
                let opciones = ['- - -', 'Orientacion', 'Atención y Concentración', 'Memoria', 'Funciones Ejecutivas',
                    'Lenguaje',
                    'Percepcion'
                ];
                let valores = ['', 'Orientacion', 'Atención y Concentración', 'Memoria', 'Funciones Ejecutivas', 'Lenguaje',
                    'Percepcion'
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

            } else if (valor.value == "grado") {
                let select = document.createElement("select");
                select.name = 'buscar';
                select.className = 'form-control';
                let opciones = ['- - -', 'Normal Alto', 'Normal', 'Leve Moderada', 'Severo'];
                let valores = ['', 'Normal Alto', 'Normal', 'Leve Moderada', 'Severo'];
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