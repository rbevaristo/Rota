<?php

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', 'PagesController@index');

//User Routes
Auth::routes();

Route::group([], function() {
    // Custom Auth Routes
    Route::get('login/admin', 'Auth\LoginController@loginAsAdmin')->name('auth.admin');
    Route::get('verify/{token}', 'Auth\RegisterController@verify');

    // Views
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/dashboard/setup', 'HomeController@setup')->name('user.setup');
    Route::get('/dashboard/manage', 'HomeController@manage')->name('user.manage');
    Route::get('/dashboard/schedule', 'UserController@schedule')->name('user.schedule');
    Route::get('/dashboard/messages', 'UserController@messages')->name('user.messages');
    Route::get('/dashboard/employee', 'UserController@employee')->name('user.employee');
    Route::get('/dashboard/attendance', 'UserController@attendance')->name('user.attendance');
    Route::get('/dashboard/performance-evaluation', 'UserController@performance')->name('user.performance');
    Route::get('/dashboard/profile', 'UserController@profile')->name('user.profile');
    Route::get('/dashboard/employee/{id}', 'EmployeesController@show');
    Route::get('/dashboard/view/pdf', 'FilesController@evaluation')->name('evaluation.pdf');
    Route::get('/dashboard/scheduler/settings', 'UserController@settings')->name('user.settings');
    //Create
    Route::post('/dashboard/employee/create', 'UserController@store');
    Route::post('/dashboard/setup/company/create', 'CompanyController@store')->name('user.company.create');
    Route::get('/dashboard/message/create', 'MessageController@messageToUser');
    Route::post('/dashboard/employee/{id}/evaluation_results', 'EvaluationResultsController@store')->name('user.employee.evaluation');
    Route::post('/dashboard/position/create', 'PositionsController@store')->name('user.position.create');
    Route::post('/dashboard/employee/upload/file', 'EmployeesController@upload')->name('upload.excel.file');
    // Updates
    Route::post('/dashboard/profile/update', 'UserProfileController@update')->name('user.profile.update');
    Route::post('/dashboard/company/update', 'CompanyController@update')->name('user.company.update');
    Route::post('/dashboard/message/approve', 'MessageController@approve')->name('user.request.approve');
    Route::get('/dashboard/message/read', 'MessageController@read')->name('user.message.read');
    Route::post('/dashboard/manage/status/update', 'EmployeesController@update_status');
    Route::post('/dashboard/evaluation/status/update', 'EvaluationResultsController@update_status');
    Route::post('/dashboard/employee/position/update', 'PositionsController@update_position');
    //Route::get('/dashboard/settings', 'UserController@settings')->name('user.settings');
    //Route::post('/dashboard/settings/update-setting/{id}/{setting}/{value}', 'SettingsController@update');
    //Route::post('/dashboard/positions/update-position/{id}/{positions}', 'PositionsController@update');
    //Route::delete('/dashboard/positions/delete-position/{id}', 'PositionsController@destroy');
    //Route::post('/dashboard/requests/update-request/{id}/{request}', 'RequestsController@update');
    //Route::delete('/dashboard/requests/delete-request/{id}', 'RequestsController@destroy');
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

    Route::post('/dashboard/message/create', 'Employee\MessageController@messageToUser')->name('employee.message.create');
    Route::post('/dashboard/requests/create', 'Employee\MessageController@requestToUser')->name('employee.request.create');


    Route::post('/dashboard/change-password', 'Employee\ChangePasswordController@update')->name('employee.change-password');
    Route::post('/dashboard/password-check/{password}', 'Employee\ChangePasswordController@check')->name('employee.password-check');

    Route::post('/dashboard/profile/update', 'Employee\UserProfileController@update')->name('employee.profile.update');
    Route::get('/dashboard/message/read', 'Employee\MessageController@read')->name('employee.message.read');
});
Route::get('test', function(){
    return view('pdf.test');
});

Route::get('/page-not-found', function(){
    return view('errors.404');
})->name('not.found');
// Route::post('/dashboard/notifications/get', 'MessageController@notification');
// Route::post('/dashboard/notification/read', 'MessageController@read');