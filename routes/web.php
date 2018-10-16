<?php

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


Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
Route::get('/admin/{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );

Route::post('/admin/kategori/tambah','ProdukController@tambah');
Route::post('/admin/kategori','ProdukController@getkategoridetail');
Route::post('/admin/kategori/update/{id}','ProdukController@update');
//upload image
Route::post('/admin/image/upload','UploadController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/admin/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});
Route::post('/sendemail','MailController@sendemail');
//
Route::post('api/user/{id}', 'API\userController@show');

Route::get('/sendattachmentemail','MailController@attachment_email');


// ======================== ROUTE UNTUK USER ========================================

Route::get('/','blog\homeController@index');
Route::get('/getproduk','blog\homeController@getprodukall');
//Route::get('/register', 'blog\homeController@register');
//Route::post('/register','blog\homeController@addusers');



// Auth::routes();

 //Route::get('/home', 'HomeController@index')->name('home');

