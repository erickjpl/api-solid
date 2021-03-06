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

Route::get('sincronizador/solicitar/{tipo}/{opcion}/{tienda}', '\App\Http\Controllers\Solid\Sincronizador\SolicitarDataController@solicitar');
Route::get('sincronizador/buscar', '\App\Http\Controllers\Solid\Sincronizador\SolicitarDataController@buscar');

Route::get('sincronizador/solicitar/descarga/{tiendas?}', '\App\Http\Controllers\Solid\Sincronizador\DescargarDataController@solicitar');
