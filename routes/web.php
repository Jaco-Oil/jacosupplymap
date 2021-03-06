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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes(['register' => false]);
//Auth::routes();



Route::prefix('admin')->group(function () {

    Route::redirect('/', 'login');

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//    Route::post('register', 'Auth\RegisterController@register');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.update');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

    Route::group(['middleware' => ['auth', 'web']], function () {

        Route::get('dashboard', 'Backend\DashboardController@index')->name('dashboard');
        Route::get('profile', 'Backend\ProfileController@index')->name('profile');

    });


});



//Frontend
//Route::get('/{vue}', 'Frontend\IndexController@index')->where('vue', '.*');
