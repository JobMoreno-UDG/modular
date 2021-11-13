<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActividadController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('{id_doctor}/pacientes',PacientesController::class)->middleware('auth');

Route::post('pacientes/{id}',[PacientesController::class,'store'])->name('pacientes.store')->middleware('auth');
/*Route::get('{id_doctor}/paciente',[PacientesController::class,'index'])->name('pacientes.index')->middleware('auth');
*/
Route::get('{id_doctor}/pacientes/{paciente}/historial',
            [PacientesController::class,'history'])->name('pacientes.history')
            ->middleware('auth');

Route::get('{id_doctor}/pacientes/{paciente}/actividades',
            [PacientesController::class,'set_activity'])
            ->name('pacientes.activity')->middleware('auth');


Route::post('{id_doctor}/pacientes/{paciente}/actividades/update',
            [PacientesController::class,'activity_update'])
            ->name('pacientes.activity_update')->middleware('auth');

Route::post('{id_doctor}/pacientes/',
            [PacientesController::class,'search'])
            ->name('pacientes.search')->middleware('auth');










Route::get('usuaro/{usuario}/perfil',[UserController::class,'perfil'])->name('usuario.perfil')->middleware('auth');

Route::resource('{usuario}/actividades',PacientesController::class)->except([
    'index', 'store'
])->middleware('auth');

Route::get('{usuario}/activdades',[ActividadController::class,'index'])->name('actividades.index')->middleware('auth');
Route::post('{usuario}/activdades/registro',[ActividadController::class,'registro'])->name('actividades.registro')->middleware('auth');
Route::post('{usuario}/activdades/buscar',[ActividadController::class,'buscar'])->name('actividades.buscar')->middleware('auth');
