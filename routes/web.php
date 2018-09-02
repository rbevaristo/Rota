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
    Route::get('employee/password/reset', 'ResetController@index')->name('employee.index');
    Route::post('employee/password/reset', 'ResetController@reset')->name('employee.reset');
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
    Route::post('/dashboard/employee/create', 'EmployeesController@store');
    Route::post('/dashboard/setup/company/create', 'CompanyController@store')->name('user.company.create');
    Route::get('/dashboard/message/create', 'MessageController@messageToUser');
    Route::post('/dashboard/employee/{id}/evaluation_results', 'EvaluationResultsController@store')->name('user.employee.evaluation');
    Route::post('/dashboard/position/create', 'PositionsController@store')->name('user.position.create');
    Route::post('/dashboard/employee/upload/file', 'EmployeesController@upload')->name('upload.excel.file');
    Route::post('/dashboard/setting/shift/create', 'SettingsController@create_shift');
    Route::post('/dashboard/setting/shift/required/create', 'SettingsController@create_required_shift')->name('user.required.shift');
    Route::get('/dashboard/scheduler/generate', 'SchedulerController@schedule')->name('user.schedule.generate');
    Route::post('/send', 'ContactUsController@send')->name('message.send');
    // Updates
    Route::post('/dashboard/profile/update', 'UserProfileController@update')->name('user.profile.update');
    Route::post('/dashboard/company/update', 'CompanyController@update')->name('user.company.update');
    Route::post('/dashboard/message/approve', 'MessageController@approve')->name('user.request.approve');
    Route::get('/dashboard/message/read', 'MessageController@read')->name('user.message.read');
    Route::post('/dashboard/manage/status/update', 'EmployeesController@update_status');
    Route::post('/dashboard/evaluation/status/update', 'EvaluationResultsController@update_status');
    Route::post('/dashboard/employee/position/update', 'PositionsController@update_position');
    Route::post('/dashboard/setting/update', 'SettingsController@update');
    Route::post('/dashboard/setting/shift/update', 'SettingsController@update_shift');
    Route::post('/dashboard/setting/shift/activate', 'SettingsController@activate_shift');
    Route::post('/dashboard/setting/shift/delete', 'SettingsController@delete_shift');
    Route::post('/dashboard/setting/criteria/update', 'SettingsController@update_criteria');
    Route::post('/dashboard/scheduler/create', 'SchedulerController@create');
    Route::post('/dashboard/setting/schedule-dayoff/update', 'SettingsController@update_dayoff');
    Route::post('/dashboard/employee/update/all', 'EmployeesController@update_all');
    Route::post('/dashboard/password/reset', 'ResetController@password_reset');
   
});


Route::post('employee/login', 'Employee\LoginController@login')->name('employee.login');
//Employee Routes
Route::group([
    'prefix' => 'employee'
], function() {
    
    Route::get('dashboard', 'Employee\EmployeeController@index')->name('employee.dashboard');
    Route::post('logout', 'Employee\LoginController@logout')->name('employee.logout');
    //Route::post('password/email', 'Employee\ForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
    //Route::get('password/reset', 'Employee\ForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
    //Route::post('password/reset', 'Employee\ResetPasswordController@reset');

    Route::get('/dashboard/profile', 'Employee\EmployeeRoutesController@profile')->name('employee.profile');
    Route::get('/dashboard/messages', 'Employee\EmployeeRoutesController@messages')->name('employee.messages');
    Route::get('/dashboard/schedule', 'Employee\EmployeeRoutesController@schedule')->name('employee.schedule');
    Route::get('/dashboard/evaluation', 'Employee\EmployeeRoutesController@evaluation')->name('employee.evaluation');

    Route::post('/dashboard/message/create', 'Employee\MessageController@messageToUser')->name('employee.message.create');
    Route::post('/dashboard/requests/create', 'Employee\MessageController@requestToUser')->name('employee.request.create');


    Route::post('/dashboard/change-password', 'Employee\ChangePasswordController@update')->name('employee.change-password');
    Route::post('/dashboard/password-check/{password}', 'Employee\ChangePasswordController@check')->name('employee.password-check');

    Route::post('/dashboard/profile/update', 'Employee\UserProfileController@update')->name('employee.profile.update');
    Route::get('/dashboard/message', 'Employee\MessageController@view')->name('employee.message.view');
    Route::get('/dashboard/message/read', 'Employee\MessageController@read')->name('employee.message.read');
    Route::get('/dashboard/evaluation/read', 'Employee\EvaluationController@read')->name('employee.evaluation.read');
    Route::post('/dashboard/preference/update', 'PreferenceController@preference')->name('employee.preferences');

});


Route::get('/page-not-found', function(){
    return view('errors.404');
})->name('not.found');
// Route::post('/dashboard/notifications/get', 'MessageController@notification');
// Route::post('/dashboard/notification/read', 'MessageController@read');