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
Route::get('blog', 'FrontendController@blog');


Route::post('create-user', 'UserController@createUser');
Route::post('login-user', 'UserController@loginUser');

Route::get('admin/login', 'AdminController@login');
Route::get('consultant/login', 'ConsultantController@login');

Route::post('{type}/login/', 'Auth\AuthController@postLogin');

// CONSULTANT

Route::group(['prefix' => 'consultant', 'middleware' => 'auth:consultant'], function () {
    Route::get('/', 'ConsultantController@index');
    Route::get('logout', 'Auth\AuthController@getConsultantLogout');
});

// ADMIN

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'AdminController@index');
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
        Route::group(['prefix' => 'consultant'], function(){
            Route::get('list', 'AdminController@listConsultants');
            Route::get('create', 'AdminController@createConsultant');
            Route::post('save', 'AdminController@saveConsultant');
            Route::get('profile/{id}', 'AdminController@detailsConsultant');
            Route::post('update-data/{id}', 'AdminController@updateConsultantData');
            Route::post('update-login/{id}/{type}', 'AdminController@updateConsultantLogin');
            Route::delete('delete-profile/{id}', 'AdminController@destroyConsultant');
        });
    });
    Route::get('logout', 'Auth\AuthController@getAdminLogout');
});