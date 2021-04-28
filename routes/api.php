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

Route::get("/", function(){
    return response()->json(["api" => "API REST-FUll de la libreria PDF"]);
});


Route::post('login', 'UserController@login');


Route::group(['middleware' => 'auth:api'], function () {

    Route::apiResource('productos', App\Http\Controllers\ProductoController::class);
    Route::put('set_like/{id}', [App\Http\Controllers\ProductoController::class, 'setLike'])->name('set_like');
    Route::put('set_dislike/{id}', [App\Http\Controllers\ProductoController::class, 'setDislike'])->name('set_dislike');
    Route::put('set_imagen/{id}', [App\Http\Controllers\ProductoController::class, 'setImagen'])->name('set_imagen');

    Route::post('logout', 'UserController@logout');

});
