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

Route::middleware('auth:api')->get('user', function (Request $request) {return $request->user();});

Route::get('realties', 'App\Http\Controllers\RealtyController@index');
Route::group(['prefix' => 'realty'], function () {
    Route::post('add', 'App\Http\Controllers\RealtyController@add');
    Route::get('edit/{id}', 'App\Http\Controllers\RealtyController@edit');
    Route::post('update/{id}', 'App\Http\Controllers\RealtyController@update');
    Route::delete('delete/{id}', 'App\Http\Controllers\RealtyController@delete');
    Route::post('/import', 'App\Http\Controllers\RealtyController@import');
});
