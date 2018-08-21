<?php
Route::group([

    'prefix' => 'v1'

], function () {

    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::get('me', 'Api\AuthController@me');
    Route::get('employees', 'Api\AuthController@employees');
});