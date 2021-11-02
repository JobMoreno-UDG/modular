<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacientesController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


#Pacientes
Route::get('pacientes',[PacientesController::class,'index'])->name('pacientes.index');
Route::get('pacientes/registro',[PacientesController::class,'registro'])->name('pacientes.registro');
