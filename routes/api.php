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



Route::prefix('v1')->middleware('access')->group(function () {
  Route::post('register', 'Api\V1\Auth\RegisterController@register');
  Route::post('login', 'Api\V1\Auth\LoginController@login');
  Route::post('login/social', 'Api\V1\Auth\LoginController@social');

  Route::get('picture', 'Api\V1\ImageController@index')->name('picture.index');
  Route::get('picture/category/{slug}', 'Api\V1\ImageController@category')->name('picture.category');
  Route::get('picture/user/{user}', 'Api\V1\ImageController@user')->name('picture.user');

  Route::get('category', 'Api\V1\CategoryController@index')->name('category.index');
});

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::post('refresh', 'Api\V1\Auth\LoginController@refresh');
    Route::post('logout', 'Api\V1\Auth\LoginController@logout');

    Route::resource('picture', 'Api\V1\ImageController', [
        'only' => ['store', 'destroy', 'update']
    ]);

    Route::resource('profile', 'Api\V1\UserController', [
        'only' => ['show', 'update'],
        'parameters' => ['profile' => 'user']
    ]);
});

Route::prefix('v1')->middleware('admin','auth:api')->group(function () {

    Route::resource ('category', 'Api\V1\CategoryController', [
        'except' => ['edit', 'create', 'show', 'index']
    ]);
});
