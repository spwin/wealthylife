<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// FRONTEND

Route::get('/', 'FrontendController@index');
Route::get('email-confirm/{key}', 'UserController@confirmation');
/*Route::get('blog', 'FrontendController@blog');*/
Route::get('contact-us', 'FrontendController@contacts');
Route::get('features', 'FrontendController@features');
Route::get('authorize-question', 'FrontendController@authorizeQuestion');

Route::get('social-login/{provider}', 'UserController@socialLogin');
Route::get('social-callback/{provider}', 'UserController@socialCallback');

Route::post('create-question', 'UserController@questionCreate');
Route::post('clear-question', 'UserController@clearQuestion');
Route::post('clear-image', 'UserController@clearImage');

Route::post('create-user', 'UserController@createUser');
Route::post('login-user', 'UserController@loginUser');

Route::get('admin/login', 'AdminController@login');
Route::get('consultant/login', 'ConsultantController@login');

Route::post('{type}/login/', 'Auth\AuthController@postLogin');


// LOGGED

Route::group(['prefix' => 'profile', 'middleware' => 'auth:user'], function () {
    Route::get('/', 'FrontendController@profile');
    Route::get('{id}/question-payment', 'FrontendController@paymentQuestion');
    Route::get('{id}/view-answer', 'FrontendController@viewAnswer');
    Route::get('notifications', 'FrontendController@notifications');
    Route::get('notifications/{id}', 'FrontendController@showNotification');
    Route::get('questions', 'FrontendController@questions');
    Route::get('articles', 'FrontendController@articles');
    Route::get('vouchers', 'FrontendController@vouchers');
    Route::get('credits', 'FrontendController@credits');
    Route::get('logout', 'Auth\AuthController@getUserLogout');
    Route::post('{id}/question-delete', 'UserController@deleteQuestion');
    Route::post('{id}/question-update', 'UserController@updateQuestion');
    Route::post('{id}/update-profile-login/{type}', 'UserController@updateProfileLogin');
    Route::post('{id}/update-profile-general', 'UserController@updateProfileGeneral');
    Route::post('change-avatar', 'UserController@changeAvatar');
    Route::post('{id}/checkout', 'UserController@payment');
    Route::post('{id}/points-checkout', 'UserController@pointsPayment');
});

// CONSULTANT

Route::group(['prefix' => 'consultant', 'middleware' => 'auth:consultant'], function () {
    Route::get('/', 'ConsultantController@index');
    Route::get('logout', 'Auth\AuthController@getConsultantLogout');
    Route::group(['prefix' => 'users'], function(){
        Route::get('list', 'ConsultantController@listUsers');
        Route::get('profile/{id}', 'ConsultantController@detailsUser');
    });
    Route::group(['prefix' => 'questions'], function(){
        Route::get('pending', 'ConsultantController@listPending');
        Route::get('answered', 'ConsultantController@listAnswered');
        Route::get('pending/{id}/answer', 'ConsultantController@answerQuestion');
        Route::get('{id}/preview', 'ConsultantController@answerPreview');
        Route::post('pending/{id}/save', 'ConsultantController@answerSave');
        Route::post('pending/{id}/send', 'ConsultantController@answerSend');
    });
});

// ADMIN

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::post('save-settings', 'AdminController@saveSettings');
    Route::group(['prefix' => 'users'], function(){
        Route::group(['prefix' => 'admins'], function(){
            Route::get('list', 'AdminController@listAdmins');
            Route::get('create', 'AdminController@createAdmin');
            Route::post('save', 'AdminController@saveAdmin');
            Route::get('profile/{id}', 'AdminController@detailsAdmin');
            Route::post('update-data/{id}', 'AdminController@updateAdminData');
            Route::post('update-login/{id}/{type}', 'AdminController@updateAdminLogin');
            Route::delete('delete-profile/{id}', 'AdminController@destroyAdmin');
        });
        Route::group(['prefix' => 'consultants'], function(){
            Route::get('list', 'AdminController@listConsultants');
            Route::get('create', 'AdminController@createConsultant');
            Route::post('save', 'AdminController@saveConsultant');
            Route::get('profile/{id}', 'AdminController@detailsConsultant');
            Route::post('update-data/{id}', 'AdminController@updateConsultantData');
            Route::post('update-login/{id}/{type}', 'AdminController@updateConsultantLogin');
            Route::delete('delete-profile/{id}', 'AdminController@destroyConsultant');
        });
        Route::group(['prefix' => 'users'], function(){
            Route::get('list', 'AdminController@listUsers');
            Route::get('profile/{id}', 'AdminController@detailsUser');
            Route::get('profile/{user_id}/mark-paid-question/{id}', 'AdminController@markPaidQuestion');
            Route::get('show-notification/{id}', 'AdminController@showNotification');
            Route::post('update-data/{id}', 'AdminController@updateUserData');
            Route::post('send-notification/{id}', 'AdminController@sendNotification');
            Route::post('update-login/{id}/{type}', 'AdminController@updateUserLogin');
            Route::post('force-login', 'AdminController@forceLoginUser');
            Route::delete('delete-profile/{id}', 'AdminController@destroyUser');
        });
    });
    Route::group(['prefix' => 'payroll'], function(){
        Route::get('/', 'AdminController@payroll');
        Route::post('pay-payroll/{id}', 'AdminController@payPayroll');
        Route::post('end-payroll/{id}', 'AdminController@endPayroll');
    });
    Route::get('logout', 'Auth\AuthController@getAdminLogout');
});