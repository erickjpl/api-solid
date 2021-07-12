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

Route::get('/', function () {
    return view('welcome');
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('vendedors', App\Http\Controllers\Sincronizador\Sincronizador\VendedorController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('tipoAjus', App\Http\Controllers\Sincronizador\Sincronizador\TipoAjuController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('tipoAjus', App\Http\Controllers\Sincronizador\Sincronizador\TipoAjuController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('tipoAjus', App\Http\Controllers\Sincronizador\Sincronizador\TipoAjuController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('ctaIngrs', App\Http\Controllers\Sincronizador\Sincronizador\CtaIngrController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('segmentos', App\Http\Controllers\Sincronizador\Sincronizador\SegmentoController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('tipoPros', App\Http\Controllers\Sincronizador\Sincronizador\TipoProController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('zonas', App\Http\Controllers\Sincronizador\Sincronizador\ZonaController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('provs', App\Http\Controllers\Sincronizador\Sincronizador\ProvController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('tabulados', App\Http\Controllers\Sincronizador\Sincronizador\TabuladoController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('unidades', App\Http\Controllers\Sincronizador\Sincronizador\UnidadesController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('procedens', App\Http\Controllers\Sincronizador\Sincronizador\ProcedenController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'sincronizador'], function () {
    Route::resource('tipoClis', App\Http\Controllers\Sincronizador\Sincronizador\TipoCliController::class, ["as" => 'sincronizador']);
});


Route::group(['prefix' => 'configuracion'], function () {
    Route::resource('connections', App\Http\Controllers\Configuracion\Configuracion\ConnectionController::class, ["as" => 'configuracion']);
});
