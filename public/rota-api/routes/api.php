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
    Route::get('evaluations/{id}', 'EvaluationFilesController@eval');

});

Route::group([

    'prefix' => 'v1/employee'

], function () {

    Route::post('login', 'AuthEmployeeController@login');
    Route::post('logout', 'AuthEmployeeController@logout');
    Route::post('refresh', 'AuthEmployeeController@refresh');
    Route::post('me', 'AuthEmployeeController@me');
    
});