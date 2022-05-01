<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/main', function () {
    return view('contenido/contenido');
})->name('main');

Route::get('grupo-riesgo', [App\Http\Controllers\PacienteController::class, 'getGrupoRiego']);
Route::get('fabricante', [App\Http\Controllers\PacienteController::class, 'getFrabricante']);
Route::get('edades', [App\Http\Controllers\PacienteController::class, 'getVEdades']);
Route::get('grupo-riesgo-dosis', [App\Http\Controllers\PacienteController::class, 'getGrupoRiesgoDosis']);
Route::get('sector-dosis', [App\Http\Controllers\PacienteController::class, 'getGrupoSectorDosis']);
Route::get('fabricante-dosis', [App\Http\Controllers\PacienteController::class, 'getFabricanteDosis']);
Route::post('import-list-excel', [App\Http\Controllers\ImporExcelController::class, 'postImportExcel'])->name('import.excel');
Route::get('import', [App\Http\Controllers\ImporExcelController::class, 'index'])->name('import');
Route::get('paciente', [App\Http\Controllers\PacienteController::class, 'getPaciente']);
Route::get('distrito-dosis', [App\Http\Controllers\PacienteController::class, 'getDistritosDosis']);

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
