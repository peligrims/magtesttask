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
//Start page
Route::get('/', function () {return view('welcome');});
Route::get('/laravelimport', function () {return view('laravelimport');})->name('laravelimport');
Route::get('/app', function () {return view('app');})->name('app');
Route::post('/users/upload', 'App\Http\Controllers\UsersController@create')->name('users');
Route::get('/users/get', 'App\Http\Controllers\UsersController@show')->name('get');




//Route::get('{any}', function () {return view('app');})->where('any', '.*');

//Route::get('import', 'App\Http\Controllers\RealtyController@create' );
//Route::post('import', 'App\Http\Controllers\RealtyController@store' );
//Route::get('/import-form', 'App\Http\Controllers\RealtyController@importForm');

