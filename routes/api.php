<?php

Route::group([
    'middleware' => 'CORS',
    'prefix' => 'v1'

], function ($router) {

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');

    Route::post('send', 'Api\ContactUsController@send');
    Route::get('employees', 'Api\UserController@employees');
    Route::get('evaluations/{id}', 'Api\EvaluationController@eval');
    Route::get('evaluationform', 'Api\EvaluationController@form');
    Route::post('evaluate', 'Api\EvaluationController@evaluate');
    Route::get('profile', 'Api\ProfileController@profile');
    Route::post('profile/update', 'Api\ProfileController@update');
    Route::get('schedule', 'Api\ScheduleController@schedule');
});

Route::group([
    'middleware' => 'CORS',
    'prefix' => 'v1/employee'

], function ($router) {

    Route::post('login', 'Api\AuthEmployeeController@login');
    Route::post('logout', 'Api\AuthEmployeeController@logout');
    Route::post('refresh', 'Api\AuthEmployeeController@refresh');
    Route::post('me', 'Api\AuthEmployeeController@me');

    Route::get('profile', 'Api\Employee\ProfileController@profile');
    Route::post('profile/update', 'Api\Employee\ProfileController@update');
    Route::get('evaluation/files', 'Api\Employee\EvaluationController@evaluation');
    Route::post('request/leave', 'Api\Employee\UserRequestController@send');
    
});
