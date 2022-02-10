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
    Route::get('/regenerate/{token}', 'UserController@regenerate')->name('regenerate');
});





//Route::get('/welcome', function () {
//    return view('auth.register');
//})->name('register');
//
//
//Route::get('login', function () {
//    return view('auth.login');
//})->name('login');
//
//Route::post('registe', function () {
//    echo 'register';
//});



Route::get('/', 'RateController@index');
Route::get('/test', 'TestController@index');
Route::get('/one', 'TestController@one');
//Route::get('/date', 'RateController@date');
//Route::get('/json', 'RateController@json');
