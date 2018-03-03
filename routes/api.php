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



Route::middleware('access')->group(function () {
  Route::post('register', 'Api\Auth\RegisterController@register');
  Route::post('login', 'Api\Auth\LoginController@login');
  Route::post('refresh', 'Api\Auth\LoginController@refresh');


  Route::get('picture', 'Api\ImageController@index')->name('picture.index');
  Route::get('picture/category/{slug}', 'Api\ImageController@category')->name('picture.category');
  Route::get('picture/user/{user}', 'Api\ImageController@user')->name('picture.user');

  Route::get('category', 'Api\CategoryController@index')->name('category.user');
});

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'Api\Auth\LoginController@logout');

    // Route::resource('picture', 'Api\ImageController', [
    //     'only' => ['create', 'store', 'destroy', 'update']
    // ]);
});
