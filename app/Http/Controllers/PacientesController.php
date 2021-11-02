<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes;

class PacientesController extends Controller
{
    public function index(){
        $pacientes = Pacientes::paginate(10);
        return view('Pacientes.index',compact('pacientes'));
    }
    public function registro(){
        return view('Pacientes.registro');
    }
}
