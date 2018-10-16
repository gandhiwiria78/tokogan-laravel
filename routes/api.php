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


Route::apiResources(['user'=>'API\userController']);
Route::apiResources(['galeri'=>'API\galeriController']);
Route::apiResources(['chat'=>'API\ChatController']);
Route::apiResources(['kategori'=>'API\ProdukController']);
Route::apiResources(['produk'=>'API\ProdukDetailController']);
Route::apiResources(['produksikategori'=>'API\ProdukKategoriController']);
Route::apiResources(['test'=>'API\test']);


