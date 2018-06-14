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
//Route::post('donor/send/rejection','DonationController@sendRejectionMail');


//assistant routes
Route::get('assistant/appointments', 'DonationController@getAllAppointments');
Route::get('assistant/containers', 'BloodContainerController@getAllBloodContainers');
Route::get('blood/requests', 'BloodRequestController@getAllBloodRequests');
Route::get('blood/requests/{bloodRequest}', 'BloodRequestController@getBloodRequestAssistant');
Route::patch('blood/requests/{bloodRequest}/status', 'BloodRequestController@changeBloodRequestStatus');
Route::get('assistant/donations','DonationController@getAllDonations');
Route::patch('assistant/donor/{donor}','DonorController@updateProfileInfo');
Route::post('assistant/request/{bloodRequest}/fulfill','BloodContainerController@assignContainers');
Route::get('assistant/donors','DonorController@getAllDonors');
Route::post('assistant/donor/{donor}/mail','DonorController@callForDonation');
//blood journey routes
Route::post('assistant/donation/{donation}/register','DonationController@moveToRegistered');
Route::post('assistant/donation/{donation}/collect','DonationController@moveToCollected');
Route::post('assistant/donation/{donation}/analyze','DonationController@moveToAnalyzed');
Route::post('assistant/donation/{donation}/store','DonationController@moveToStored');
Route::post('assistant/donation/{donation}/reject','DonationController@rejectionReason');

//doctor routes
Route::post('blood/request','BloodRequestController@createBloodRequest');
Route::get('blood/request/history','BloodRequestController@returnHistory');
Route::get('blood/requests/history/{bloodRequest}', 'BloodRequestController@getBloodRequestDoctor');
Route::get('doctor/requests', 'BloodRequestController@getMyBloodRequests');
//admin routes
Route::post('admin/invite', 'InvitationController@invite');
Route::get('admin/users', 'AdminController@users');


Route::get('invitation', 'InvitationController@invitation');