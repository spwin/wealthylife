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
    $sizes = config('sizes.blog-masonry');
    if(!is_null($width) && !is_null($name) && in_array($width, $sizes)){
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
    $sizes = config('sizes.blog');
    if(!is_null($size) && !is_null($name) && in_array($size, $sizes)){
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

Route::get('/blog-masonry-consultant/{width}/{name}', function($width = NULL, $name = NULL){
    $path = \Illuminate\Support\Facades\Input::get('path');
    $path = rawurldecode($path);
    $path = str_replace('.','',$path);
    $sizes = config('sizes.blog-masonry-consultant');
    if(!is_null($width) && !is_null($name) && !is_null($path) && in_array($width, $sizes)){
        try {
            $cache_image = Image::cache(function($image) use($width, $name, $path){
                return $image->make(url(ltrim($path, '/').$name))->resize($width, null, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
            }, 1000);
            return Response::make($cache_image, 200, ['Content-Type' => 'image']);
        } catch (Intervention\Image\Exception\NotReadableException $e) {
            abort(404);
        }
    } else {
        abort(404);
    }
});

Route::get('/consultant-blog/{size}/{name}', function($size = NULL, $name = NULL){
    $path = \Illuminate\Support\Facades\Input::get('path');
    $path = rawurldecode($path);
    $path = str_replace('.','',$path);
    $sizes = config('sizes.consultant-blog');
    if(!is_null($size) && !is_null($name) && !is_null($path) && in_array($size, $sizes)){
        $size = explode('x', $size);
        try {
            $cache_image = Image::cache(function($image) use($size, $name, $path){
                return $image->make(url(ltrim($path, '/').$name))->resize($size[0], $size[1], function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
            }, 1000);
            return Response::make($cache_image, 200, ['Content-Type' => 'image']);
        } catch (Intervention\Image\Exception\NotReadableException $e) {
            abort(404);
        }
    } else {
        abort(404);
    }
});

Route::get('/photo/{size}/{name}', function($size = NULL, $name = NULL){
    $sizes = config('sizes.photo');
    if(!is_null($size) && !is_null($name) && in_array($size, $sizes)){
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

Route::get('/photo-crop/{size}/{name}', function($size = NULL, $name = NULL){
    $sizes = config('sizes.photo-crop');
    if(!is_null($size) && !is_null($name) && in_array($size, $sizes)){
        $size = explode('x', $size);
        $cache_image = Image::cache(function($image) use($size, $name){
            return $image->make(url('uploads/questions/'.$name))->fit($size[0], $size[1], function ($c) {
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
    $sizes = config('sizes.temp');
    if(!is_null($size) && !is_null($name) && in_array($size, $sizes)){
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
Route::get('sitemap', 'FrontendController@sitemap');

// FRONTEND
//Route::get('soon', 'FrontendController@soon');
Route::post('soon/submit', 'FrontendController@soonSubmit');

// NO ACCESS LIMIT PAGES
Route::get('/', 'FrontendController@index');

Route::get('contact-us', 'FrontendController@contacts');
Route::get('about-us', 'FrontendController@about');
Route::get('privacy-policy', 'FrontendController@privacy');
Route::get('terms-and-conditions', 'FrontendController@terms');
Route::get('the-team', 'FrontendController@team');
Route::get('examples', 'FrontendController@examples');
Route::post('send-form', 'FrontendController@contactForm');
Route::post('leave-feedback', 'UserController@leaveFeedback');
Route::get('blog', 'FrontendController@blog');
Route::get('blog/{url}', 'FrontendController@blogEntry');

// LIMITED ACCESS PAGES
Route::group(['middleware' => ['limited_access']], function () {

    Route::post('/get-answer-time', 'FrontendController@ajaxCheckAnswerTime');
    Route::get('email-confirm/{key}', 'UserController@confirmation');
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

    Route::get('reset-password', 'FrontendController@passwordReset');
    Route::get('new-password/{token}', 'FrontendController@newPassword');
    Route::get('password-changed', 'FrontendController@changedPassword');
    Route::post('reset-process', 'UserController@resetPassword');
    Route::post('save-password/{id}', 'UserController@savePassword');

    Route::get('accept-referral', 'FrontendController@acceptReferral');
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
        Route::get('notifications/mark-as-read', 'UserController@markNotifications');
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
        Route::post('ajax-pending', 'ConsultantController@ajaxPending');
        Route::post('ajax-timer/{id}', 'ConsultantController@saveTimer');
        Route::group(['prefix' => 'users'], function () {
            Route::get('list', 'ConsultantController@listUsers');
            Route::get('profile/{id}', 'ConsultantController@detailsUser');
        });
        Route::group(['prefix' => 'questions'], function () {
            Route::get('interactive', 'ConsultantController@interactiveAnswer');
            Route::get('pending', 'ConsultantController@listPending');
            Route::get('answered', 'ConsultantController@listAnswered');
            Route::get('rejected', 'ConsultantController@listRejected');
            Route::get('pending/{id}/answer', 'ConsultantController@answerQuestion');
            Route::get('{id}/preview', 'ConsultantController@answerPreview');
            Route::get('rejected/{id}/rejection', 'ConsultantController@rejectionPreview');
            Route::post('pending/{id}/reject', 'ConsultantController@rejectQuestion');
            Route::post('pending/{id}/save', 'ConsultantController@answerSave');
            Route::post('pending/{id}/send', 'ConsultantController@answerSend');
        });
        Route::group(['prefix' => 'articles'], function () {
            Route::get('/', 'ConsultantController@articles');
            Route::get('create', 'ConsultantController@createArticle');
            Route::get('edit/{id}', 'ConsultantController@editArticle');
            Route::post('save', 'ConsultantController@saveArticle');
            Route::post('update/{id}', 'ConsultantController@updateArticle');
            Route::get('blog/preview/{url}', 'ConsultantController@previewArticle');
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
                Route::post('disable-profile/{id}/{disable}', 'AdminController@disableConsultant');
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
                Route::post('disable-profile/{id}/{disable}', 'AdminController@disableUser');
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
        Route::group(['prefix' => 'pending'], function () {
            Route::get('/', 'AdminController@pending');
            Route::get('change-consultant/{id}', 'AdminController@changeConsultant');
        });
        Route::group(['prefix' => 'rejections'], function () {
            Route::get('/', 'AdminController@rejections');
            Route::get('preview/{id}', 'AdminController@showRejection');
        });
        Route::group(['prefix' => 'phrases'], function () {
            Route::get('/', 'AdminController@phrases');
            Route::get('edit/{id}', 'AdminController@editPhrase');
            Route::post('process', 'AdminController@processPhrases');
            Route::post('update/{id}', 'AdminController@updatePhrase');
            Route::post('change/{id}/{action}', 'AdminController@changePhrase');
        });
        Route::group(['prefix' => 'vouchers'], function () {
            Route::get('list', 'AdminController@vouchers');
            Route::get('created', 'AdminController@createdVouchers');
            Route::get('list/details/{id}', 'AdminController@voucherDetails');
            Route::get('created/details/{id}', 'AdminController@createdVoucherDetails');
            Route::post('created/create-voucher', 'AdminController@createVoucher');
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

Route::get('feed', function(){
    $feed = App::make("feed");
    //$feed->setCache(60, 'rssFeedKey');

    if (/*!$feed->isCached()*/ true)
    {
        $articles = \App\Article::where(['status' => 3])->orderBy('published_at', 'desc')->take(20)->get();

        $feed->title = 'StyleSensei Blog';
        $feed->description = 'Fashion inspiration for people by people';
        $feed->logo = url()->to('/').'/images/logo-meta.png';
        $feed->link = url('feed');
        $feed->setDateFormat('datetime');
        $feed->pubdate = $articles[0]->created_at;
        $feed->lang = 'en';
        $feed->setShortening(true);
        $feed->setTextLimit(500);

        foreach ($articles as $article)
        {
            $url = action('FrontendController@blogEntry', ['url' => $article->url]);
            $author = $article->hide_name ? env('APP_NAME') : $article->user->userData->first_name.' '.$article->user->userData->first_name;
            $image = $article->user->type == 'user' ? url()->to('/').'/blog/500x500/'.$article->image->filename : url()->to('/').'/consultant-blog/500x500/'.$article->image->filename.'?path='.rawurlencode($article->image->path);
            $description = '<img src="'.$image.'" /> '.$article->title;
            $feed->add($article->title, $author, $url, $article->published_at, $description, $article->content);
        }

    }
    return $feed->render('atom');
});