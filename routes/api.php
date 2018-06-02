<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::get('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\AuthController@register');
    Route::post('invitation/register', 'Auth\AuthController@invitationRegister');

});

//donor routes
Route::post('donor/profile', 'DonorController@store');
Route::get('donor/profile','DonorController@getProfileInfo');
Route::post('donor/appointments', 'DonationController@createAppointment');
Route::get('donor/appointments', 'DonationController@returnHistory');


//assistant routes
Route::get('assistant/appointments', 'DonationController@getAllAppointments');
Route::get('assistant/containers', 'BloodContainerController@getAllBloodContainers');
Route::get('blood/requests', 'BloodRequestController@getAllBloodRequests');
Route::get('blood/requests/{bloodRequest}', 'BloodRequestController@getBloodRequestAssistant');
Route::patch('blood/requests/{bloodRequest}/status', 'BloodRequestController@changeBloodRequestStatus');
Route::patch('assistant/donor/{donor}','DonorController@updateProfileInfo');



//doctor routes
Route::post('blood/request','BloodRequestController@createBloodRequest');
Route::get('blood/request/history','BloodRequestController@returnHistory');
Route::get('blood/requests/history/{bloodRequest}', 'BloodRequestController@getBloodRequestDoctor');
//admin routes
Route::post('admin/invite', 'InvitationController@invite');
Route::get('invitation', 'InvitationController@invitation');