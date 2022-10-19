<?php

use App\Http\Controllers\V1\DocentesAPIController;
use App\Http\Controllers\V1\AuthController;

use App\Http\Controllers\V1\ReporteAPIController;

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

// PARTE DE REYNA 
Route::group(["auth:sanctum"],function(){
    Route::post("reportes_guardar", [ReporteAPIController::class,'store'] );
    Route::delete("reportes_eliminar/{id_reporte}",[ReporteAPIController::class,'destroy']);
});

Route::prefix('v1')->group(function () {

    Route::post('login', [AuthController::class, 'authenticate']);
    //Todas las rutas aqui dentro requieren autenticación
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('get-user', [AuthController::class, 'getUser']);
        Route::get('docentes', [DocentesAPIController::class, 'index']);
        Route::get('docentes/{clave}', [DocentesAPIController::class, 'show']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
