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
Route::get('/', 'RateController@index');

Route::group(['middleware' => 'guest'], function (){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::view('profile', 'profile')->name('profile');
    Route::get('tokens', 'UserController@tokens')->name('tokens');
    Route::get('pdf', 'UserController@pdf')->name('pdf');
    Route::get('/regenerate/{token}', 'UserController@regenerate')->name('regenerate');


});

Route::get('test', 'RateController@test');
