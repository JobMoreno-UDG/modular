<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes;
use App\Models\Actividad;
use App\Models\Historial;
use App\Models\ProcesosCognitivos;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PacientesController extends Controller
{
    public function index($id)
    {
        $pacientes = Pacientes::where('id_doctor', '=', $id)->get();
        return view('Pacientes.index', compact('pacientes'));
    }
    public function create()
    {
        return view('Pacientes.registro');
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);
        $paciente = Pacientes::create([
            'nombre' => $request->nombre,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'genero' => $request->genero,
            'escolaridad' => $request->escolaridad,
            'enfermedad' => $request->enfermedad,
            'enfermedades' => implode(',', $request->enfermedades) ?? 'Ninguna',
            'id_doctor' => $id
        ]);
        $id_paciente = $paciente->id;
        ProcesosCognitivos::create([
            'id_paciente' => $id_paciente,
            'orientacion' => $request->orientacion,
            'atencion_concentracion' => $request->atencion_concentarcion,
            'memoria' => $request->memoria,
            'funciones_ejecutivas' => $request->f_ejecutivas,
            'lenguaje' => $request->lenguaje,
            'percepcion' => $request->percepcion,
        ]);
        return redirect()->route('pacientes.index', $id);
    }
    public function show($id, Pacientes $paciente)
    {
        $cognicion = ProcesosCognitivos::where('id_paciente', $paciente->id)->get();
        if (count($cognicion) > 0) {
            $cognicion = $cognicion[0];
        }

        $activity = Historial::where('id_paciente', $paciente->id)->get();
        if (count($activity) > 0) {
            $activity = $activity[count($activity) - 1];
        }

        $activity = collect($activity);
        $activitys = collect();
        $nombres = ['', '', 'Orientacion', 'Atención y Concentración', 'Memoria', 'Funciones Ejecutivas', 'Lenguaje', 'Percepcion'];
        $cont = 0;
        foreach ($activity as $key => $value) {
            $item = collect();
            $campo = $nombres[$cont];
            if (strpos($value, ',')) {
                $buscar = explode(',', $value);
            } else {
                $buscar = [$value];
            }
            for ($i = 0; $i < count($buscar); $i++) {
                $act = Actividad::select('id', 'nombre', 'especializa', 'grado', 'descripcion')->where('especializa', '=', $campo)->where('id', '=', $buscar[$i])->get();
                $item->add($act);
            }
            $activitys->add($item);
            $cont = $cont + 1;
            if ($cont == 7) {
                break;
            }
        }
        $activity = $activitys;
        return view('Pacientes.show', compact('paciente', 'cognicion', 'activity'));
    }
    public function history($id, Pacientes $paciente)
    {
        $total = ProcesosCognitivos::where('id_paciente', $paciente->id)->get();
        $first = $total[0];
        $last = $total[count($total) - 1];
        $actividades = Historial::where('id_paciente', $paciente->id)->orderBy('id', 'DESC')->get();
        $nombres = ['orientacion', 'atencion_concentracion', 'memoria', 'funciones_ejecutivas', 'lenguaje', 'percepcion'];
        $actividades = collect($actividades);
        $new_actividades = collect();
        foreach ($actividades as $key => $value) {
            $cont = 0;
            $item = collect();
            $value = collect($value);
            foreach ($value as $llave => $valor) {
                $campo = $nombres[$cont];
                if ($llave == $campo) {
                    if (strpos($valor, ',')) {
                        $buscar = explode(',', $valor);
                    } else {
                        $buscar = [$valor];
                    }

                    $cont = $cont + 1;
                    $fecha = $value->get('created_at');
                    for ($i = 0; $i < count($buscar); $i++) {
                        $act = Actividad::select('id', 'nombre', 'especializa', 'grado', 'descripcion')->find($valor);
                        if ($act != Null) {
                            $act = collect($act);
                            $act->push($fecha);
                            $item->add($act);
                           
                        }
                    }
                }
                if ($cont == 6) {
                    $new_actividades->add($item);
                    break;
                }
            }
        }
        //return $new_actividades;
        return view('Pacientes.historial', compact('paciente', 'total', 'first', 'last', 'new_actividades'));
    }
    public function set_activity($id, Pacientes $paciente)
    {
        $total = ProcesosCognitivos::where('id_paciente', $paciente->id)->get();
        $actividad = $total[count($total) - 1];


        $orientacion = Actividad::where('especializa', '=', 'Orientacion')->where('grado', '>=', $actividad->orientacion)->get();
        $atencion = Actividad::where('especializa', '=', 'Atención y Concentración')->where('grado', '>=', $actividad->atencion_concentracion)->get();
        $memoria = Actividad::where('especializa', '=', 'Memoria')->where('grado', '>=', $actividad->memoria)->get();
        $funciones = Actividad::where('especializa', '=', 'Funciones Ejecutivas')->where('grado', '>=', $actividad->funciones_ejecutivas)->get();
        $lenguaje = Actividad::where('especializa', '=', 'Lenguaje')->where('grado', '>=', $actividad->lenguaje)->get();
        $percepcion = Actividad::where('especializa', '=', 'Percepcion')->where('grado', '>=', $actividad->percepcion)->get();

        $actividades = [
            'Orientacion' => $orientacion, 'Atención y Concentracion' => $atencion, 'Memoria' => $memoria,
            'Funciones Ejecutivas' => $funciones, 'Lenguaje' => $lenguaje, 'Percepción' => $percepcion
        ];

        return view('Pacientes.actividades', compact('paciente', 'actividades', 'actividad'));
    }
    public function activity_update($id_doctor, Request $request, Pacientes $paciente)
    {
        $request->validate([
            'aceptar' => 'required'
        ]);
        $id = $paciente->id;
        Historial::create([
            'id_paciente' => $id,
            'orientacion' => (Arr::exists($request, 'Orientacion')) ? implode(',', $request->Orientacion) : '',
            'atencion_concentracion' => (Arr::exists($request, 'Atención_y_Concentracion')) ? implode(',', $request->Atención_y_Concentracion) : '',
            'memoria' => (Arr::exists($request, 'Memoria')) ? implode(',', $request->Memoria) : '',
            'funciones_ejecutivas' => (Arr::exists($request, 'Funciones_Ejecutivas')) ? implode(',', $request->Funciones_Ejecutivas) : '',
            'lenguaje' => (Arr::exists($request, 'Lenguaje')) ? implode(',', $request->Lenguaje) : '',
            'percepcion' => (Arr::exists($request, 'Percepcion')) ? implode(',', $request->Percepcion) : ''
        ]);
        return Redirect()->route('pacientes.show', ['id_doctor' => $id_doctor, 'paciente' => $id]);
    }
    public function search($id, Request $request)
    {
        if ($request->ajax()) {
            $pacientes = Pacientes::where($request->buscar_por, 'LIKE', '%' . $request->buscar . '%')->paginate(5);
            return view('Pacientes.plantilla', compact('pacientes'))->render();
        }
        //return response(json_encode($pacientes),200)->header('Content-type','text/plain');
    }
    public function edit($id, Pacientes $paciente){
        return view('Pacientes.edit',compact('paciente'));
    }
}
