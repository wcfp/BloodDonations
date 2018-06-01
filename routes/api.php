<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::get('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\AuthController@register');
});

//donor routes
Route::post('donor/profile', 'DonorController@store');
Route::post('donor/appointments', 'DonationController@createAppointment');
Route::get('donor/appointments', 'DonationController@returnHistory');


//assistant routes
Route::get('assistant/appointments', 'DonationController@getAllAppointments');
Route::get('blood/requests', 'BloodRequestController@getAllBloodRequests');
Route::get('blood/requests/{bloodRequest}', 'BloodRequestController@getBloodRequest');
Route::patch('blood/requests/{bloodRequest}/status', 'BloodRequestController@changeBloodRequestStatus');

//doctor routes
Route::post('blood/request','BloodRequestController@createBloodRequest');
Route::get('blood/request/history','BloodRequestController@returnHistory');

//admin routes

