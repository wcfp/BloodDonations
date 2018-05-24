<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::get('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\AuthController@register');
});

Route::post('appointments', 'DonationController@createAppointment');
Route::get('appointments', 'DonationController@returnHistory');
Route::post('donor/profile', 'DonorController@store');

Route::post('blood/request','BloodRequestController@createBloodRequest');
Route::get('appointments', 'DonationController@getAllAppointments');