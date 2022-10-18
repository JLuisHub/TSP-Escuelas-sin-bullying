<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('reportes', ReporteController::class);

Route::group(["auth:sanctum"],function(){
    Route::get("reportes_guardar","App\Http\Controllers\ReporteController@store");
    Route::get("reportes_eliminar/{id_reporte}","App\Http\Controllers\ReporteController@destroy");
});