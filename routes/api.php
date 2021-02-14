<?php

use Illuminate\Http\Request;

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

Route::get('/categorias', 'ControladorCategoria@indexJson');
Route::resource('/produtos', 'ControladorProduto');
Route::post('/produtos', 'ControladorProduto@store');
Route::delete('/produtos/{id}', 'ControladorProduto@destroy');
Route::get('/produtos/{id}', 'ControladorProduto@show');
Route::put('/produtos/{id}', 'ControladorProduto@update');
