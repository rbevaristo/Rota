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

Route::get('/', function () {
    return view('welcome');
});

//User Routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin Routes

Route::group(['prefix' => 'admin'], function() {
    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::post('password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset', 'Admin\ResetPasswordController@reset');
});


//Employee Routes
Route::group(['prefix' => 'employee'], function() {
    Route::get('home', 'EmployeeController@index')->name('employee.home');
    Route::get('login', 'Employee\LoginController@showLoginForm')->name('employee.login');
    Route::post('login', 'Employee\LoginController@login');
    Route::post('logout', 'Employee\LoginController@logout')->name('employee.logout');
    Route::post('password/email', 'Employee\ForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
    Route::get('password/reset', 'Employee\ForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
    Route::post('password/reset', 'Employee\ResetPasswordController@reset');
});
