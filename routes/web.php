<?php

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', 'PagesController@index');

//User Routes
Auth::routes();

Route::group([], function() {
    Route::get('login/admin', 'Auth\LoginController@loginAsAdmin')->name('auth.admin');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/dashboard/setup', 'HomeController@setup')->name('user.setup');
    Route::get('/dashboard/manage', 'HomeController@manage')->name('user.manage');
    Route::post('/dashboard/manage/status/update', 'EmployeesController@update_status');
    Route::post('/dashboard/setup/company/create', 'CompanyController@store')->name('user.company.create');
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
    Route::post('/dashboard/profile/update', 'UserProfileController@update')->name('user.profile.update');
    Route::post('/dashboard/company/update', 'CompanyController@update')->name('user.company.update');
    Route::get('verify/{token}', 'Auth\RegisterController@verify');

    Route::get('/dashboard/employee/{id}', 'EmployeesController@show');
    Route::post('/dashboard/employee/{id}/evaluation_results', 'EvaluationResultsController@store')->name('user.employee.evaluation');
    Route::get('/dashboard/message/create', 'MessageController@messageToUser');
    Route::get('/dashboard/notification/markAsRead', 'MessageController@markRead')->name('markRead');
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
    Route::get('dashboard', 'Employee\EmployeeController@index')->name('employee.dashboard');
    Route::post('logout', 'Employee\LoginController@logout')->name('employee.logout');
    Route::post('password/email', 'Employee\ForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
    Route::get('password/reset', 'Employee\ForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
    Route::post('password/reset', 'Employee\ResetPasswordController@reset');

    Route::get('/dashboard/profile', 'Employee\EmployeeRoutesController@profile')->name('employee.profile');
    Route::get('/dashboard/messages', 'Employee\EmployeeRoutesController@messages')->name('employee.messages');
    Route::get('/dashboard/schedule', 'Employee\EmployeeRoutesController@schedule')->name('employee.schedule');
    Route::get('/dashboard/evaluation', 'Employee\EmployeeRoutesController@evaluation')->name('employee.evaluation');

    Route::get('/dashboard/message/create', 'MessageController@messageToUser')->name('employee.message.create');
    Route::post('/dashboard/requests/create', 'MessageController@requestToUser')->name('employee.request.create');


    Route::post('/dashboard/change-password', 'Employee\ChangePasswordController@update')->name('employee.change-password');
    Route::post('/dashboard/password-check/{password}', 'Employee\ChangePasswordController@check')->name('employee.password-check');

    Route::post('/dashboard/profile/update', 'Employee\UserProfileController@update')->name('employee.profile.update');
    
});

// Route::post('/dashboard/notifications/get', 'MessageController@notification');
// Route::post('/dashboard/notification/read', 'MessageController@read');