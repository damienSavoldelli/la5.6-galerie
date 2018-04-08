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



Route::prefix('V1')->middleware('access')->group(function () {
  Route::post('register', 'Api\v1\Auth\RegisterController@register');
  Route::post('login', 'Api\v1\Auth\LoginController@login');

  Route::get('picture', 'Api\v1\ImageController@index')->name('picture.index');
  Route::get('picture/category/{slug}', 'Api\v1\ImageController@category')->name('picture.category');
  Route::get('picture/user/{user}', 'Api\v1\ImageController@user')->name('picture.user');

  Route::get('category', 'Api\v1\CategoryController@index')->name('category.index');
});

Route::prefix('V1')->middleware('auth:api')->group(function () {
    Route::post('refresh', 'Api\v1\Auth\LoginController@refresh');
    Route::post('logout', 'Api\v1\Auth\LoginController@logout');

    Route::resource('picture', 'Api\v1\ImageController', [
        'only' => ['store', 'destroy', 'update']
    ]);

    Route::resource('profile', 'Api\v1\UserController', [
        'only' => ['show', 'update'],
        'parameters' => ['profile' => 'user']
    ]);
});

Route::prefix('V1')->middleware('admin','auth:api')->group(function () {

    Route::resource ('category', 'Api\v1\CategoryController', [
        'except' => ['edit', 'create', 'show', 'index']
    ]);
});
