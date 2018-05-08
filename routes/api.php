<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::get('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\AuthController@register');
});

Route::post('appointment', 'DonationController@createAppointment');
