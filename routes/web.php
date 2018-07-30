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
Route::get('login-as-admin', 'Auth\LoginController@loginAsAdmin')->name('auth.admin');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/dashboard/setup', 'HomeController@setup')->name('user.setup');
Route::get('/dashboard/setup-2', 'HomeController@setup2')->name('user.setup2');
Route::post('/dashboard/setup/company/create', 'CompanyController@store')->name('user.company.create');
Route::group([], function() {
    Route::get('/dashboard/profile', 'UserController@profile')->name('user.profile');
    Route::get('/dashboard/schedule', 'UserController@schedule')->name('user.schedule');
    Route::get('/dashboard/employee', 'UserController@employee')->name('user.employee');
    Route::get('/dashboard/attendance', 'UserController@attendance')->name('user.attendance');
    Route::get('/dashboard/performance-evaluation', 'UserController@performance')->name('user.performance');
    Route::get('/dashboard/settings', 'UserController@settings')->name('user.settings');
    Route::post('/dashboard/settings/update-setting/{id}/{setting}/{value}', 'SettingsController@update');
    Route::post('/dashboard/positions/update-position/{id}/{positions}', 'PositionsController@update');
    Route::delete('/dashboard/positions/delete-position/{id}', 'PositionsController@destroy');
    Route::post('/dashboard/requests/update-request/{id}/{request}', 'RequestsController@update');
    Route::delete('/dashboard/requests/delete-request/{id}', 'RequestsController@destroy');
    Route::post('/dashboard/employee/create', 'UserController@store');
});

//Admin Routes

Route::group([
    'prefix' => 'admin'
], function() {
    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::post('password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset', 'Admin\ResetPasswordController@reset');
});


Route::post('employee/login', 'Employee\LoginController@login')->name('employee.login');
//Employee Routes
Route::group([
    'prefix' => 'employee'
], function() {
    Route::get('dashboard', 'EmployeeController@index')->name('employee.dashboard');
    // Route::get('login', 'Employee\LoginController@showLoginForm')->name('employee.login');
    Route::post('logout', 'Employee\LoginController@logout')->name('employee.logout');
    Route::post('password/email', 'Employee\ForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
    Route::get('password/reset', 'Employee\ForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
    Route::post('password/reset', 'Employee\ResetPasswordController@reset');

    Route::get('/dashboard/profile', 'EmployeeRoutesController@profile')->name('employee.profile');
    Route::get('/dashboard/messages', 'EmployeeRoutesController@messages')->name('employee.messages');
    Route::get('/dashboard/schedule', 'EmployeeRoutesController@schedule')->name('employee.schedule');
    Route::get('/dashboard/evaluation', 'EmployeeRoutesController@evaluation')->name('employee.evaluation');

    Route::post('/dashboard/messages/create', 'MessageController@messageToUser')->name('employee.message.create');
    Route::post('/dashboard/requests/create', 'MessageController@requestToUser')->name('employee.request.create');

});
