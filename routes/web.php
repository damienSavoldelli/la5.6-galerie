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

Route::redirect('/home', '/', 301);

Route::name('home')->get('/', 'HomeController@index');
Route::name('language')->get('language/{lang}', 'HomeController@language');

Route::name('category')->get('category/{slug}', 'ImageController@category');
Route::name('user')->get('user-picture-{user}', 'ImageController@user');

// Social Auth
Route::name('social')->get('login/{provider}', 'Auth\socialController@redirectToProvider');
Route::name('social.callback')->get('login/{provider}/callback', 'Auth\socialController@handleProviderCallback');

Route::middleware('admin')->group(function () {
    Route::resource ('category', 'CategoryController', [
        'except' => 'show'
    ]);

    Route::name('maintenance.index')->get('maintenance', 'AdminController@index');
    Route::name('maintenance.destroy')->delete('maintenance', 'AdminController@destroy');
});


Route::middleware('auth')->group(function () {
    Route::resource('image', 'ImageController', [
        'only' => ['create', 'store', 'destroy', 'update']
    ]);

    Route::resource('profile', 'UserController', [
        'only' => ['edit', 'update'],
        'parameters' => ['profile' => 'user']
    ]);
});
