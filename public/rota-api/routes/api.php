<?php

Route::group([

    'prefix' => 'v1'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post('send', 'ContactUsController@send');
    Route::get('employees', 'UserController@employees');
    Route::get('evaluations/{id}', 'EvaluationController@eval');
    Route::get('evaluationform', 'EvaluationController@form');
    Route::post('evaluate', 'EvaluationController@evaluate');
    Route::get('profile', 'ProfileController@profile');
    Route::post('profile/update', 'ProfileController@update');
});

Route::group([

    'prefix' => 'v1/employee'

], function () {

    Route::post('login', 'AuthEmployeeController@login');
    Route::post('logout', 'AuthEmployeeController@logout');
    Route::post('refresh', 'AuthEmployeeController@refresh');
    Route::post('me', 'AuthEmployeeController@me');

    Route::get('profile', 'Employee\ProfileController@profile');
    Route::post('profile/update', 'Employee\ProfileController@update');
    Route::get('evaluation/files', 'Employee\EvaluationController@evaluation');
    Route::post('request/leave', 'Employee\UserRequestController@send');
    
});