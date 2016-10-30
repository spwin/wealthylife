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
// IMAGES CACHE
Route::get('/blog-masonry/{width}/{name}', function($width = NULL, $name = NULL){
    if(!is_null($width) && !is_null($name)){
        $cache_image = Image::cache(function($image) use($width, $name){
            return $image->make(url('uploads/blog/'.$name))->resize($width, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
        }, 1000);

        return Response::make($cache_image, 200, ['Content-Type' => 'image']);
    } else {
        abort(404);
    }
});

Route::get('/blog/{size}/{name}', function($size = NULL, $name = NULL){
    if(!is_null($size) && !is_null($name)){
        $size = explode('x', $size);
        $cache_image = Image::cache(function($image) use($size, $name){
            return $image->make(url('uploads/blog/'.$name))->resize($size[0], $size[1], function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
        }, 1000);

        return Response::make($cache_image, 200, ['Content-Type' => 'image']);
    } else {
        abort(404);
    }
});

Route::get('/photo/{size}/{name}', function($size = NULL, $name = NULL){
    if(!is_null($size) && !is_null($name)){
        $size = explode('x', $size);
        $cache_image = Image::cache(function($image) use($size, $name){
            return $image->make(url('uploads/questions/'.$name))->resize($size[0], $size[1], function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
        }, 1000);
        return Response::make($cache_image, 200, ['Content-Type' => 'image']);
    } else {
        abort(404);
    }
});

Route::get('/temp/{size}/{dir}/{name}', function($size = NULL, $dir = NULL, $name = NULL){
    if(!is_null($size) && !is_null($name)){
        $size = explode('x', $size);
        $cache_image = Image::cache(function($image) use($size, $dir, $name){
            return $image->make(url('uploads/session/temp/'.$dir.'/'.$name))->resize($size[0], $size[1], function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
        }, 1000);
        return Response::make($cache_image, 200, ['Content-Type' => 'image']);
    } else {
        abort(404);
    }
});

Route::get('sitemap.xml', 'FrontendController@sitemap');

// FRONTEND
Route::get('soon', 'FrontendController@soon');
Route::post('soon/submit', 'FrontendController@soonSubmit');
Route::group(['middleware' => ['ip']], function () {
    Route::get('/', 'FrontendController@index');

    Route::get('email-confirm/{key}', 'UserController@confirmation');
    Route::get('blog', 'FrontendController@blog');
    Route::get('contact-us', 'FrontendController@contacts');
    Route::get('about-us', 'FrontendController@about');
    Route::get('privacy-policy', 'FrontendController@privacy');
    Route::get('terms-and-conditions', 'FrontendController@terms');
    Route::get('the-team', 'FrontendController@team');
    Route::get('authorize-question', 'FrontendController@authorizeQuestion');

    Route::get('blog/', 'FrontendController@blog');
    Route::get('blog/{url}', 'FrontendController@blogEntry');

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
    Route::post('send-form', 'FrontendController@contactForm');

    Route::get('reset-password', 'FrontendController@passwordReset');
    Route::get('new-password/{token}', 'FrontendController@newPassword');
    Route::get('password-changed', 'FrontendController@changedPassword');
    Route::post('reset-process', 'UserController@resetPassword');
    Route::post('save-password/{id}', 'UserController@savePassword');

    Route::get('accept-referral', 'FrontendController@acceptReferral');
    Route::post('leave-feedback', 'UserController@leaveFeedback');
// LOGGED

    Route::group(['prefix' => 'profile', 'middleware' => 'auth:user'], function () {
        Route::get('welcome', 'UserController@welcome');
        Route::get('/', 'FrontendController@summary');
        Route::get('account', 'FrontendController@profile');
        Route::get('referral-program', 'FrontendController@referral');
        Route::get('{id}/checkout-question', 'FrontendController@checkoutQuestion');
        Route::get('{id}/question-payment', 'FrontendController@paymentQuestion');
        Route::get('{id}/view-answer', 'FrontendController@viewAnswer');
        Route::get('notifications', 'FrontendController@notifications');
        Route::get('notifications/{id}', 'FrontendController@showNotification');
        Route::get('questions', 'FrontendController@questions');
        Route::get('{id}/question', 'FrontendController@viewQuestion');
        Route::group(['prefix' => 'articles'], function () {
            Route::get('/', 'FrontendController@articles');
            Route::get('new', 'FrontendController@newArticle');
            Route::get('{id}/preview', 'FrontendController@previewArticle');
            Route::get('{id}/edit', 'FrontendController@editArticle');
            Route::post('create', 'UserController@createArticle');
            Route::post('{id}/save', 'UserController@saveArticle');
            Route::post('{id}/submit', 'UserController@submitArticle');
        });
        Route::get('credits', 'FrontendController@credits');
        Route::get('logout', 'Auth\AuthController@getUserLogout');
        Route::post('{id}/process-question', 'UserController@processQuestion');
        Route::post('{id}/question-delete', 'UserController@deleteQuestion');
        Route::post('{id}/question-update', 'UserController@updateQuestion');
        Route::post('{id}/update-profile-login/{type}', 'UserController@updateProfileLogin');
        Route::post('{id}/update-profile-general', 'UserController@updateProfileGeneral');
        Route::post('change-avatar', 'UserController@changeAvatar');
        Route::post('{id}/checkout', 'UserController@payment');
        Route::post('{id}/points-checkout', 'UserController@pointsPayment');
        Route::post('credits-payment', 'UserController@paymentCredits');
        Route::post('{id}/checkout-credits', 'UserController@checkoutCredits');
        Route::post('{id}/rate-answer', 'UserController@rateAnswer');
        Route::group(['prefix' => 'vouchers'], function () {
            Route::get('/', 'FrontendController@vouchers');
            Route::get('buy', 'FrontendController@buyVoucher');
            Route::post('pay', 'UserController@payVoucher');
            Route::get('payment/{id}', 'UserController@formPaymentVoucher');
            Route::post('checkout/{id}', 'UserController@checkoutVoucher');
            Route::post('check', 'UserController@checkVoucher');
        });
    });

// CONSULTANT

    Route::group(['prefix' => 'consultant', 'middleware' => 'auth:consultant'], function () {
        Route::get('/', 'ConsultantController@index');
        Route::get('logout', 'Auth\AuthController@getConsultantLogout');
        Route::group(['prefix' => 'users'], function () {
            Route::get('list', 'ConsultantController@listUsers');
            Route::get('profile/{id}', 'ConsultantController@detailsUser');
        });
        Route::group(['prefix' => 'questions'], function () {
            Route::get('pending', 'ConsultantController@listPending');
            Route::get('answered', 'ConsultantController@listAnswered');
            Route::get('pending/{id}/answer', 'ConsultantController@answerQuestion');
            Route::get('{id}/preview', 'ConsultantController@answerPreview');
            Route::post('pending/{id}/save', 'ConsultantController@answerSave');
            Route::post('pending/{id}/send', 'ConsultantController@answerSend');
        });
        Route::group(['prefix' => 'timetable'], function () {
            Route::get('/', 'ConsultantController@timetable');
        });
    });

// ADMIN

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', 'AdminController@index');
        Route::post('save-settings', 'AdminController@saveSettings');
        Route::group(['prefix' => 'users'], function () {
            Route::group(['prefix' => 'admins'], function () {
                Route::get('list', 'AdminController@listAdmins');
                Route::get('create', 'AdminController@createAdmin');
                Route::post('save', 'AdminController@saveAdmin');
                Route::get('profile/{id}', 'AdminController@detailsAdmin');
                Route::post('update-data/{id}', 'AdminController@updateAdminData');
                Route::post('update-login/{id}/{type}', 'AdminController@updateAdminLogin');
                Route::delete('delete-profile/{id}', 'AdminController@destroyAdmin');
            });
            Route::group(['prefix' => 'consultants'], function () {
                Route::get('list', 'AdminController@listConsultants');
                Route::get('create', 'AdminController@createConsultant');
                Route::post('save', 'AdminController@saveConsultant');
                Route::get('profile/{id}', 'AdminController@detailsConsultant');
                Route::post('update-data/{id}', 'AdminController@updateConsultantData');
                Route::post('update-timetable/{id}', 'AdminController@updateConsultantTimetable');
                Route::post('update-login/{id}/{type}', 'AdminController@updateConsultantLogin');
                Route::delete('delete-profile/{id}', 'AdminController@destroyConsultant');
            });
            Route::group(['prefix' => 'users'], function () {
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
        Route::group(['prefix' => 'articles'], function () {
            Route::get('/{type}', 'AdminController@articles');
            Route::get('/details/{id}', 'AdminController@detailsArticle');
            Route::post('/edit/{id}', 'AdminController@editArticle');
        });
        Route::group(['prefix' => 'timetable'], function () {
            Route::get('/', 'AdminController@timetable');
        });
        Route::group(['prefix' => 'balance'], function () {
            Route::get('/', 'AdminController@balance');
            Route::post('add-credits', 'AdminController@addBalance');
            Route::post('add-balance/{id}', 'AdminController@addProfileBalance');
        });
        Route::group(['prefix' => 'payroll'], function () {
            Route::get('/', 'AdminController@payroll');
            Route::get('view/{id}', 'AdminController@viewPayroll');
            Route::post('pay-payroll/{id}', 'AdminController@payPayroll');
            Route::post('end-payroll/{id}', 'AdminController@endPayroll');
        });
        Route::group(['prefix' => 'answers'], function () {
            Route::get('/', 'AdminController@answers');
            Route::get('preview/{id}', 'AdminController@showAnswer');
        });
        Route::group(['prefix' => 'phrases'], function () {
            Route::get('/', 'AdminController@phrases');
            Route::get('edit/{id}', 'AdminController@editPhrase');
            Route::post('process', 'AdminController@processPhrases');
            Route::post('update/{id}', 'AdminController@updatePhrase');
            Route::post('change/{id}/{action}', 'AdminController@changePhrase');
        });
        Route::group(['prefix' => 'vouchers'], function () {
            Route::get('/', 'AdminController@vouchers');
            Route::get('detils/{id}', 'AdminController@voucherDetails');
        });
        Route::group(['prefix' => 'discounts'], function () {
            Route::get('/', 'AdminController@discounts');
            Route::get('create', 'AdminController@createDiscount');
            Route::post('save', 'AdminController@saveDiscount');
        });
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'AdminController@orders');
        });
        Route::group(['prefix' => 'prices'], function () {
            Route::get('/', 'AdminController@prices');
            Route::get('create-price', 'AdminController@createPrice');
            Route::get('edit-price/{id}', 'AdminController@editPrice');
            Route::post('save-price', 'AdminController@savePrice');
            Route::post('delete-price/{id}', 'AdminController@deletePrice');
            Route::post('update-price/{id}', 'AdminController@updatePrice');
        });
        Route::group(['prefix' => 'ratings'], function () {
            Route::get('/', 'AdminController@ratings');
        });
        Route::group(['prefix' => 'feedback'], function () {
            Route::get('{type}', 'AdminController@feedback');
        });
        Route::get('logout', 'Auth\AuthController@getAdminLogout');
    });
});