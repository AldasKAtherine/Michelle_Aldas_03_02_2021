<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/estudiantes/{cedula}', 'EstudiantesController@getEstudiante');
Route::get('/resoluciones/estudiante/{id}', 'ResolucionesController@getResoluiones');

/**
 * para aplicacion en android
 */

 Route::get('/autenticar/{correo}/{contrasena}','UsuariosController@autenticarAbogado');
 Route::get('/consejos','ConsejosController@getConsejos');
 Route::get('/resolucionesConsejo/{consejoId}','ResolucionesController@resolucionesConsejos');