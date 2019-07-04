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


Route::apiResource('users', 'AdminApi\UserController');
Route::apiResource('permissions', 'Test');
Route::apiResource('roles', 'AdminApi\Rolecontroller');

Route::apiResource('suplier', 'SuplierController');
Route::get('kategori', 'KategoriController@index');
Route::post('kategori', 'KategoriController@store');
Route::put('kategori/{id}', 'KategoriController@update');
Route::apiResource('barang', 'BarangController');

Route::get('nota', 'TransaksiPenjualanController@index');
Route::post('nota', 'TransaksiPenjualanController@store');

Route::apiResource('jabatan', 'JabatanController');
Route::apiResource('piket', 'PiketController');