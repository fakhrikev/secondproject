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

Route::group(['middleware' => 'api'], function () {
    Route::prefix('Product')->group(function () {
        Route::get('GetAll/', 'productsController@GetAll');
        Route::get('GetByID/{id}/', 'productsController@GetByID');
        Route::post('Store/', 'productsController@Store');
        Route::put('Update/{id}/', 'productsController@Update');
        Route::delete('Delete/{id}/', 'productsController@Delete');
    });

    Route::prefix('ProductImage')->group(function () {
        Route::get('GetWithParam/', 'productImageController@GetWithParam');
        Route::post('Store/', 'productImageController@Store');
        Route::put('SetMainImage/{id}/', 'productImageController@SetMainImage');
        Route::delete('Delete/{id}/', 'productImageController@Delete');
    });
});





