<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComunaController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\DepartamentoController;

Route::get('/', function () {
    return view('welcome');
});

//RUTAS COMUNA

Route::get('/comunas', [ComunaController::class, 'index'])->name('comunas.index');
Route::get('/comunas/create', [ComunaController::class, 'create'])->name('comunas.create');
Route::post('/comunas', [ComunaController::class, 'store'])->name('comunas.store');
Route::delete('/comunas/{comuna}', [ComunaController::class, 'destroy'])->name('comunas.destroy');
Route::put('/comunas/{comuna}', [ComunaController::class, 'update'])->name('comunas.update');
Route::get('/comunas/{comuna}/edit', [ComunaController::class, 'edit'])->name('comunas.edit');

//RUTAS MUNICIPIO


Route::get('/municipios', [MunicipioController::class, 'index'])->name('municipios.index');
Route::post('/municipios', [MunicipioController::class, 'store'])->name('municipios.store');
Route::get('/municipios/create', [MunicipioController::class, 'create'])->name('municipios.create');
Route::delete('/municipios/{municipio}', [MunicipioController::class, 'destroy'])->name('municipios.destroy');
Route::put('/municipios/{municipio}', [MunicipioController::class, 'update'])->name('municipios.update');
Route::get('/municipios/{municipio}/edit', [MunicipioController::class, 'edit'])->name('municipios.edit');

//RUTAS DEPARTAMENTO

Route::get('/departamentos', [DepartamentoController::class, 'index']);