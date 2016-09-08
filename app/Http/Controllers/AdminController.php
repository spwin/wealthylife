<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Article;
use App\Discounts;
use App\Feedback;
use App\Helpers\Helpers;
use App\Images;
use App\Notifications;
use App\Orders;
use App\Payroll;
use App\Phrases;
use App\PriceSchemes;
use App\Questions;
use App\Settings;
use App\User;
use App\UserData;
use Braintree\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;

class AdminController extends Controller
{
    private $max_filesize = 5120;

    public function index(){
        return view('admin/dashboard/dashboard');
    }

    public function login(){
        return view('admin/login');
    }

    public function listAdmins(){
        $admins = User::with('userData')->where(['type' => 'admin'])->get();
        $colors = ['bg-red', 'bg-blue', 'bg-light-blue', 'bg-navy', 'bg-olive', 'bg-purple'];
        return view('admin/users/admins/list')->with([
            'users' => $admins,
            'colors' => $colors
        ]);
    }

    public function createAdmin(){
        return view('admin/users/admins/create');
    }

    public function saveAdmin(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'image|max:'.$this->max_filesize.'|mimes:jpeg,png',
            'gender' => 'required'
        ]);
        $v->after(function($v) use ($request) {
            if ($request->file('image') && $request->file('image')->getError()) {
                $v->errors()->add('image', 'The image may not be greater than '.$this->max_filesize.' kilobytes.');
            }
        });
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        $input = $request->all();
        $input['birth_date'] = date('Y-m-d',  strtotime(str_replace('/', '-', $input['birth_date'])));

        $input['status'] = 1;
        $input['email_confirmed'] = 1;
        $input['type'] = 'admin';
        $input['password'] = bcrypt($input['password']);
        $user = new User();
        $user->fill($input);
        $user->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $destinationPath = 'images/avatars';
            $fileName = 'user'.$user->id.'-'.$request->file('image')->getClientOriginalName();
            $img = Image::make($request->file('image'));
            $img->save($destinationPath.'/original/'.$fileName, 90);
            $img->fit(200, 200, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($destinationPath.'/'.$fileName, 90);
            $input['filename'] = $fileName;
        } else {
            $input['filename'] = 'no_image.png';
        }

        $input['path'] = '/images/avatars/';
        $image = new Images();
        $image->fill($input);
        $image->save();

        $input['user_id'] = $user->id;
        $input['image_id'] = $image->id;
        $user_data = new UserData();
        $user_data->fill($input);
        $user_data->save();

        Flash::success('Admin has been successfully added');
        return Redirect::action('AdminController@listAdmins');
    }

    public function detailsAdmin($id){
        $user = User::findOrFail($id);
        $tab = Input::has('t') ? Input::get('t') : 1;
        $user_data = UserData::findOrFail($user->id);
        return view('admin/users/admins/profile')->with([
            'user' => $user,
            'user_data' => $user_data,
            'tab' => $tab
        ]);
    }

    public function updateAdminData($id,Request $request){
        $user = User::where(['id' => $id, 'type' => 'admin'])->first();
        if(count($user) > 0){
            $user_data = UserData::where(['user_id' => $user->id])->first();
            if(count($user_data) > 0) {
                $v = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'image' => 'image|max:'.$this->max_filesize.'|mimes:jpeg,png'
                ]);
                $v->after(function($v) use ($request) {
                    if ($request->file('image') && $request->file('image')->getError()) {
                        $v->errors()->add('image', 'The image may not be greater than '.$this->max_filesize.' kilobytes.');
                    }
                });
                if ($v->fails()) {
                    return redirect()->action('AdminController@detailsAdmin', ['id' => $id, 't' => 1])->withErrors($v->errors());
                }
                $input = $request->all();
                $input['birth_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $input['birth_date'])));
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $destinationPath = 'images/avatars';
                    $fileName = 'user' . $user->id . '-' . $request->file('image')->getClientOriginalName();
                    $img = Image::make($request->file('image'));
                    $img->save($destinationPath.'/original/'.$fileName, 90);
                    $img->fit(200, 200, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($destinationPath.'/'.$fileName, 90);

                    $input['filename'] = $fileName;
                    $input['path'] = '/images/avatars/';

                    $image = new Images();
                    $image->fill($input);
                    $image->save();

                    $input['image_id'] = $image->id;

                    if ($user_data->image()->first()->filename != 'no_image.png') {
                        $url = base_path('public' . $user_data->image()->first()->path) . $user_data->image()->first()->filename;
                        if (file_exists($url))
                            unlink($url);
                    }
                }

                $user_data->fill($input);
                $user_data->save();
            }
        }
        Flash::success('Admin info has been successfully changed');
        return Redirect::action('AdminController@detailsAdmin', $id);
    }

    public function updateAdminLogin($id, $type, Request $request){
        $user = User::where(['id' => $id, 'type' => 'admin'])->first();
        $info = $request->all();
        if($type == 'email'){
            $v = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email,'.$user->email.',email',
            ]);
            if ($v->fails()) {
                return redirect()->action('AdminController@detailsAdmin', ['id' => $id, 't' => 2])->withErrors($v->errors());
            }
            if ($request->get('email') == $user->email){
                Flash::warning('Email address remains the same');
            } else {
                $user->email = $info['email'];
                Flash::success('Email has been successfully changed');
            }
        } elseif($type == 'pass'){
            $v = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ]);
            if ($v->fails()) {
                return redirect()->action('AdminController@detailsAdmin', ['id' => $id, 't' => 2])->withErrors($v->errors());
            }
            $user->password = bcrypt($info['password']);
            Flash::success('Password has been successfully changed');
        }
        $user->save();
        return Redirect::action('AdminController@detailsAdmin', ['id' => $id, 't' => 2]);
    }

    public function destroyAdmin($id){
        $user = User::findOrFail($id);
        if($id == Auth::guard('admin')->user()->id) {
            Flash::error('You cannot remove your account');
        } elseif($user->super) {
            Flash::error('You cannot remove super admin account');
        } else {
            DB::table('users')->where(['id' => $id, 'type' => 'admin'])->delete();
            Flash::error('Admin account has been removed');
        }
        return Redirect::action('AdminController@listAdmins');
    }

    public function listConsultants(){
        $consultants = User::with('userData')->where(['type' => 'consultant'])->get();
        $current = Payroll::where(['current' => 1])->first();
        $price = Settings::where(['name' => 'gross_consultant'])->first();
        return view('admin/users/consultants/list')->with([
            'users' => $consultants,
            'current' => $current,
            'price' => $price,
            'total' => 0
        ]);
    }

    public function createConsultant(){
        return view('admin/users/consultants/create');
    }

    public function saveConsultant(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'image|max:'.$this->max_filesize.'|mimes:jpeg,png',
            'gender' => 'required'
        ]);
        $v->after(function($v) use ($request) {
            if ($request->file('image') && $request->file('image')->getError()) {
                $v->errors()->add('image', 'The image may not be greater than '.$this->max_filesize.' kilobytes.');
            }
        });
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        $input = $request->all();
        $input['birth_date'] = date('Y-m-d',  strtotime(str_replace('/', '-', $input['birth_date'])));

        $input['status'] = 1;
        $input['email_confirmed'] = 1;
        $input['type'] = 'consultant';
        $input['password'] = bcrypt($input['password']);
        $user = new User();
        $user->fill($input);
        $user->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $destinationPath = 'images/avatars';
            $fileName = 'user'.$user->id.'-'.$request->file('image')->getClientOriginalName();
            $img = Image::make($request->file('image'));
            $img->save($destinationPath.'/original/'.$fileName, 90);
            $img->fit(200, 200, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($destinationPath.'/'.$fileName, 90);
            $input['filename'] = $fileName;
        } else {
            $input['filename'] = 'no_image.png';
        }

        $input['path'] = '/images/avatars/';
        $image = new Images();
        $image->fill($input);
        $image->save();

        $input['user_id'] = $user->id;
        $input['image_id'] = $image->id;
        $user_data = new UserData();
        $user_data->fill($input);
        $user_data->save();

        Flash::success('Consultant has been successfully added');
        return Redirect::action('AdminController@listConsultants');
    }

    public function detailsConsultant($id){
        $user = User::findOrFail($id);
        $tab = Input::has('t') ? Input::get('t') : 1;
        $user_data = UserData::findOrFail($user->id);
        return view('admin/users/consultants/profile')->with([
            'user' => $user,
            'user_data' => $user_data,
            'tab' => $tab
        ]);
    }

    public function updateConsultantData($id,Request $request){
        $user = User::where(['id' => $id, 'type' => 'consultant'])->first();
        if(count($user) > 0){
            $user_data = UserData::where(['user_id' => $user->id])->first();
            if(count($user_data) > 0) {
                $v = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'image' => 'image|max:'.$this->max_filesize.'|mimes:jpeg,png'
                ]);
                $v->after(function($v) use ($request) {
                    if ($request->file('image') && $request->file('image')->getError()) {
                        $v->errors()->add('image', 'The image may not be greater than '.$this->max_filesize.' kilobytes.');
                    }
                });
                if ($v->fails()) {
                    return redirect()->action('AdminController@detailsConsultant', ['id' => $id, 't' => 1])->withErrors($v->errors());
                }
                $input = $request->all();
                $input['birth_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $input['birth_date'])));
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $destinationPath = 'images/avatars';
                    $fileName = 'user' . $user->id . '-' . $request->file('image')->getClientOriginalName();
                    $img = Image::make($request->file('image'));
                    $img->save($destinationPath.'/original/'.$fileName, 90);
                    $img->fit(200, 200, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($destinationPath.'/'.$fileName, 90);

                    $input['filename'] = $fileName;
                    $input['path'] = '/images/avatars/';

                    $image = new Images();
                    $image->fill($input);
                    $image->save();

                    $input['image_id'] = $image->id;

                    if ($user_data->image()->first()->filename != 'no_image.png') {
                        $url = base_path('public' . $user_data->image()->first()->path) . $user_data->image()->first()->filename;
                        if (file_exists($url))
                            unlink($url);
                    }
                }

                $user_data->fill($input);
                $user_data->save();
            }
        }
        Flash::success('Consultant info has been successfully changed');
        return Redirect::action('AdminController@detailsConsultant', $id);
    }

    public function updateConsultantLogin($id, $type, Request $request){
        $user = User::where(['id' => $id, 'type' => 'consultant'])->first();
        $info = $request->all();
        if($type == 'email'){
            $v = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email,'.$user->email.',email',
            ]);
            if ($v->fails()) {
                return redirect()->action('AdminController@detailsConsultant', ['id' => $id, 't' => 2])->withErrors($v->errors());
            }
            if ($request->get('email') == $user->email){
                Flash::warning('Email address remains the same');
            } else {
                $user->email = $info['email'];
                Flash::success('Email has been successfully changed');
            }
        } elseif($type == 'pass'){
            $v = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ]);
            if ($v->fails()) {
                return redirect()->action('AdminController@detailsConsultant', ['id' => $id, 't' => 2])->withErrors($v->errors());
            }
            $user->password = bcrypt($info['password']);
            Flash::success('Password has been successfully changed');
        }
        $user->save();
        return Redirect::action('AdminController@detailsConsultant', ['id' => $id, 't' => 2]);
    }

    public function destroyConsultant($id){
        $user = User::findOrFail($id);
        if($id == Auth::guard('admin')->user()->id) {
            Flash::error('You cannot remove your account');
        } elseif($user->super) {
            Flash::error('You cannot remove super consultant account');
        } else {
            DB::table('users')->where(['id' => $id, 'type' => 'consultant'])->delete();
            Flash::error('Consultant account has been removed');
        }
        return Redirect::action('AdminController@listConsultants');
    }

    public function listUsers(){
        $users = User::with('userData')->where(['type' => 'user'])->orderBy('created_at', 'DESC')->get();
        return view('admin/users/users/list')->with([
            'users' => $users
        ]);
    }

    function getEmailConfirmation($user){
        if($user->local){
            if($user->email_confirmed){
                $econf = ['status' => 'via email', 'color' => 'green'];
            } else {
                $econf = ['status' => 'pending', 'color' => 'yellow'];
            }
        } else {
            $econf = ['status' => 'social', 'color' => 'gray'];
        }
        return $econf;
    }

    public function detailsUser($id){
        $user = User::findOrFail($id);
        $tab = Input::has('t') ? Input::get('t') : 1;
        $user_data = UserData::where(['user_id' => $user->id])->first();
        $econf = $this->getEmailConfirmation($user);
        return view('admin/users/users/profile')->with([
            'user' => $user,
            'user_data' => $user_data,
            'tab' => $tab,
            'econf' => $econf
        ]);
    }

    public function markPaidQuestion($userId, $id)
    {
        $result = DB::table('questions')
            ->where('id', $id)
            ->update(array('status' => 1));
        if ($result){
            Flash::success('Question #' . $id . ' has been successfully marked as paid.');
        } else {
            Flash::error('Question #'.$id.' has not been marked as paid.');
        }
        return Redirect::action('AdminController@detailsUser', ['id' => $userId]);
    }

    public function destroyUser($id){
        $user = User::findOrFail($id);
        if($id == Auth::guard('admin')->user()->id) {
            Flash::error('You cannot remove your account');
        } elseif($user->super) {
            Flash::error('You cannot remove super user account');
        } else {
            DB::table('users')->where(['id' => $id, 'type' => 'user'])->delete();
            Flash::error('User account has been removed');
        }
        return Redirect::action('AdminController@listUsers');
    }

    public function updateUserData($id,Request $request){
        $user = User::where(['id' => $id, 'type' => 'user'])->first();
        if(count($user) > 0){
            $user_data = UserData::where(['user_id' => $user->id])->first();
            if(count($user_data) > 0) {
                $v = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'image' => 'image|max:'.$this->max_filesize.'|mimes:jpeg,png'
                ]);
                $v->after(function($v) use ($request) {
                    if ($request->file('image') && $request->file('image')->getError()) {
                        $v->errors()->add('image', 'The image may not be greater than '.$this->max_filesize.' kilobytes.');
                    }
                });
                if ($v->fails()) {
                    return redirect()->action('AdminController@detailsUser', ['id' => $id, 't' => 1])->withErrors($v->errors());
                }
                $input = $request->all();
                $input['birth_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $input['birth_date'])));
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $destinationPath = 'images/avatars';
                    $fileName = 'user' . $user->id . '-' . $request->file('image')->getClientOriginalName();
                    $img = Image::make($request->file('image'));
                    $img->save($destinationPath.'/original/'.$fileName, 90);
                    $img->fit(200, 200, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($destinationPath.'/'.$fileName, 90);

                    $input['filename'] = $fileName;
                    $input['path'] = '/images/avatars/';

                    $image = new Images();
                    $image->fill($input);
                    $image->save();

                    $input['image_id'] = $image->id;

                    if ($user_data->image()->first() && $user_data->image()->first()->filename != 'no_image.png') {
                        $url = base_path('public' . $user_data->image()->first()->path) . $user_data->image()->first()->filename;
                        if (file_exists($url))
                            unlink($url);
                    }
                }

                $user_data->fill($input);
                $user_data->save();
            }
        }
        Flash::success('User info has been successfully changed');
        return Redirect::action('AdminController@detailsUser', $id);
    }

    public function updateUserLogin($id, $type, Request $request){
        $user = User::where(['id' => $id, 'type' => 'user'])->first();
        $info = $request->all();
        if($type == 'email'){
            $v = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email,'.$user->email.',email',
            ]);
            if ($v->fails()) {
                return redirect()->action('AdminController@detailsUser', ['id' => $id, 't' => 2])->withErrors($v->errors());
            }
            if ($request->get('email') == $user->email){
                Flash::warning('Email address remains the same');
            } else {
                $user->email = $info['email'];
                Flash::success('Email has been successfully changed');
            }
        } elseif($type == 'pass'){
            $v = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ]);
            if ($v->fails()) {
                return redirect()->action('AdminController@detailsUser', ['id' => $id, 't' => 2])->withErrors($v->errors());
            }
            $user->password = bcrypt($info['password']);
            Flash::success('Password has been successfully changed');
        }
        $user->save();
        return Redirect::action('AdminController@detailsUser', ['id' => $id, 't' => 2]);
    }

    public function forceLoginUser(Request $request){
        $v = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors(), 'authenticate');
        }
        $user = User::where(['id' => $request->get('id')])->first();
        if($user) {
            Auth::guard('user')->login($user);
            return Redirect::action('FrontendController@index')->withInput();
        } else {
            return Redirect::back();
        }
    }

    public function saveSettings(Request $request){
        $input = $request->all();
        foreach($input as $name => $value){
            if($name != '_token') {
                Settings::updateOrCreate(['name' => $name], ['value' => $value]);
            }
        }
        return Redirect::back();
    }

    public function sendNotification(Request $request, $id){
        $user = User::findOrFail($id);
        $user_data = $user->userData()->first();
        $input = $request->all();
        $input['email'] = $request->has('email') ? 1 : 0;
        $input['user_id'] = $id;
        $notification = new Notifications();
        $notification->fill($input);
        $notification->save();
        if($input['email']){
            Mail::send('emails.new_notification', ['user' => $user_data, 'notification' => $notification], function ($message) use ($user) {
                $message->subject('New notification');
                $message->from('spwinwk@gmail.com', 'Style Sensei');
                $message->to($user->email);
                $message->priority('high');
            });
        }
        Flash::success('Your notification was sent successfully');
        return Redirect::action('AdminController@detailsUser', ['id' => $id, 't' => 4]);
    }

    public function showNotification($id){
        $notification = Notifications::findOrFail($id);
        return view('admin/users/users/notification')->with([
            'notification' => $notification
        ]);
    }

    public function payroll(){
        $payroll = Payroll::where(['current' => 0])->orderBy('id', 'DESC')->get();
        $current = Payroll::where(['current' => 1])->first();
        $created = new Carbon($current->starts_at);
        $now = Carbon::now();
        $lasts = str_replace('before', '', $created->diffForHumans($now));
        return view('admin/payroll/index')->with([
            'payroll' => $payroll,
            'current' => $current,
            'lasts' => $lasts
        ]);
    }

    public function endPayroll(Request $request, $id){
        $payroll = Payroll::findOrFail($id);
        $payroll->ends_at = date('Y-m-d H:i:s', time());
        $payroll->paid_at = null;
        $payroll->current = 0;
        $payroll->save();
        $new = new Payroll();
        $new->fill([
            'starts_at' => date('Y-m-d H:i:s', time()),
            'ends_at' => null,
            'paid_at' => null,
            'current' => 1
        ]);
        $new->save();
        Flash::success('You have successfully begun a new payroll period');
        return Redirect::action('AdminController@payroll');
    }

    public function payPayroll(Request $request, $id){
        $payroll = Payroll::findOrFail($id);
        $payroll->paid_at = date('Y-m-d H:i:s', time());
        $payroll->save();
        Flash::success('You have successfully marked this period as paid');
        return Redirect::action('AdminController@payroll');
    }

    public function articles($type = 'pending'){
        switch($type) {
            case 'pending' : $articles = Article::with(['image', 'user'])->whereNull('published_at')->where(['status' => 1, 'reviewed' => 0])->get(); break;
            case 'edited' : $articles = Article::with(['image', 'user'])->whereNotNull('published_at')->where(['status' => 1, 'reviewed' => 0])->get(); break;
            case 'published' : $articles = Article::with(['image', 'user'])->whereNotNull('published_at')->where(['status' => 3, 'reviewed' => 1])->get(); break;
            case 'archived' : $articles = Article::with(['image', 'user'])->whereNull('published_at')->where(['status' => 2, 'reviewed' => 1])->get(); break;
            default : $articles = [];
        }
        return view('admin/articles/index')->with([
            'articles' => $articles,
            'status' => ucfirst($type)
        ]);
    }

    public function detailsArticle($id){
        $article = Article::with(['image', 'user'])->where(['id' => $id])->first();
        $type = 'pending';
        if($article->status == 1){
            if($article->published_at){
                $type = 'edited';
            } else {
                $type = 'pending';
            }
        } elseif($article->status == 2){
            $type = 'archived';
        } elseif($article->status == 3){
            $type = 'published';
        }
        $user = User::findOrFail($article->user->id);
        return view('admin/articles/details')->with([
            'article' => $article,
            'type' => $type,
            'user' => $user
        ]);
    }

    public function editArticle(Request $request, $id){
        $article = Article::findOrFail($id);
        $action = $request->get('action');
        $type = $request->get('type');
        $input = [];
        $done = '';
        switch($action){
            case 'publish':
                $input = [
                    'status' => 3,
                    'reviewed' => 1,
                    'published_at' => date('Y-m-d H:i:s', time())
                ];
                $done = 'Published';
                Helpers::sendNotification('notifications.article.published.', $article->user, ['link' => action('FrontendController@blogEntry', ['url' => $article->url])]);
                break;
            case 'archive':
                $input = [
                    'status' => 2,
                    'reviewed' => 1,
                    'published_at' => null
                ];
                $done = 'Archived';
                break;
        }
        $article->fill($input);
        $article->save();
        Flash::success('The article has been '.$done.' successfully!');
        return Redirect::action('AdminController@articles', ['type' => $type]);
    }

    public function viewPayroll($id){
        $payroll = Payroll::findOrFail($id);
        $consultants = User::with('userData')->where(['type' => 'consultant'])->get();
        $price = Settings::where(['name' => 'gross_consultant'])->first();
        return view('admin/payroll/view')->with([
            'users' => $consultants,
            'current' => $payroll,
            'price' => $price,
            'total' => 0
        ]);
    }

    public function answers(){
        $questions = Questions::where(['status' => 2])->orderBy('asked_at', 'DESC')->paginate(10);
        return view('admin/answers/list')->with([
            'questions' => $questions,
            'status' => 'Answered',
            'stat' => 2
        ]);
    }

    public function showAnswer($id){
        $answer = Answers::findOrFail($id);
        return view('admin/answers/show')->with([
            'answer' => $answer,
            'question' => $answer->question()->first()
        ]);
    }

    public function phrases(){
        $phrases = Phrases::orderBy('created_at')->paginate(20);
        return view('admin/phrases/list')->with([
            'phrases' => $phrases
        ]);
    }

    public function processPhrases(Request $request){
        $v = Validator::make($request->all(), [
            'author' => 'required',
            'text' => 'required|max:500',
            'style' => 'max:500'
        ]);

        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors())->withInput();
        }

        $input = $request->all();
        if(!$request->has('enabled')){
            $input['enabled'] = 0;
        }

        $phrase = new Phrases();
        $phrase->fill($input);
        $phrase->save();

        Flash::success('The phrase has been added successfully');
        return Redirect::action('AdminController@phrases');
    }

    public function changePhrase($id, $action){
        $phrase = Phrases::findOrFail($id);
        if($action == 'disable'){
            $phrase->enabled = 0;
        } else {
            $phrase->enabled = 1;
        }
        $phrase->save();
        return Redirect::action('AdminController@phrases');
    }

    public function editPhrase($id){
        $phrase = Phrases::findOrFail($id);
        return view('admin/phrases/edit')->with([
            'phrase' => $phrase
        ]);
    }

    public function updatePhrase(Request $request, $id){
        $v = Validator::make($request->all(), [
            'author' => 'required',
            'text' => 'required|max:500',
            'style' => 'max:500'
        ]);

        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors())->withInput();
        }

        $input = $request->all();
        if(!$request->has('enabled')){
            $input['enabled'] = 0;
        }

        $phrase = Phrases::findOrFail($id);
        $phrase->fill($input);
        $phrase->save();

        Flash::success('The phrase has been successfully saved');
        return Redirect::action('AdminController@phrases');
    }

    public function vouchers(){
        echo 'vouchers';
    }

    public function discounts(){
        $discounts = Discounts::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin/discounts/list')->with([
            'discounts' => $discounts
        ]);
    }

    public function createDiscount(){
        return view('admin/discounts/create');
    }

    public function saveDiscount(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'type' => 'required',
            'name' => 'required|max:500',
            'value' => 'required|numeric'
        ]);

        $user = User::where(['email' => $request->get('email')])->first();

        $v->after(function($v) use ($user, $request) {
            if (!$user) {
                $v->errors()->add('email', 'There is no user with email: '.$request->get('email'));
            }
        });

        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors())->withInput();
        }

        $input = $request->all();
        $input[$input['type']] = $input['value'];
        $input['user_id'] = $user->id;

        $discount = new Discounts();
        $discount->fill($input);
        $discount->save();

        Flash::success('New discount has been successfully created');
        return Redirect::action('AdminController@discounts');
    }

    public function orders(){
        $orders = Orders::orderBy('created_at', 'DESC')->paginate(20);
        $price = Settings::select('value')->where(['name' => 'question_price'])->first();
        return view('admin/orders/list')->with([
            'orders' => $orders,
            'price' => $price
        ]);
    }

    public function prices(){
        $prices = PriceSchemes::paginate(20);
        return view('admin/prices/list')->with([
            'prices' => $prices
        ]);
    }

    public function savePrice(Request $request){
        $v = Validator::make($request->all(), [
            'order' => 'required',
            'credits' => 'required',
            'price' => 'required',
            'comment' => 'max:1000'
        ]);
        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors());
        }

        $scheme = new PriceSchemes();
        $scheme->fill($request->all());
        $scheme->save();

        Flash::success('New price scheme was successfully created');
        return Redirect::action('AdminController@prices');
    }

    public function createPrice(){
        return view('admin/prices/create');
    }

    public function editPrice($id){
        $scheme = PriceSchemes::findOrFail($id);
        return view('admin/prices/edit')->with([
            'scheme' => $scheme
        ]);
    }

    public function updatePrice(Request $request, $id){
        $scheme = PriceSchemes::findOrFail($id);
        $v = Validator::make($request->all(), [
            'order' => 'required',
            'credits' => 'required',
            'price' => 'required',
            'comment' => 'max:1000'
        ]);
        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors());
        }

        $scheme->fill($request->all());
        $scheme->save();

        Flash::success('New price scheme was successfully updated');
        return Redirect::action('AdminController@prices');
    }

    public function deletePrice($id){
        $price = PriceSchemes::findOrFail($id);
        $price->delete();
        Flash::success('Password has been successfully changed');
        return Redirect::action('AdminController@prices');
    }

    public function ratings(){
        $ratings = Answers::where('rating', '>', 0)->orWhere('feedback', '<>', '')->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin/ratings/index')->with([
            'ratings' => $ratings
        ]);
    }

    public function feedback($type){
        if($type == 'all') {
            $feedback = Feedback::orderBy('created_at', 'DESC')->paginate(20);
        } elseif($type == 'unseen'){
            $feedback = Feedback::where(['seen' => 0])->orderBy('created_at', 'DESC')->get();
        }
        foreach($feedback as $f){
            $f->seen = 1;
            $f->save();
        }
        return view('admin/feedback/index')->with([
            'feedback' => $feedback,
            'type' => $type
        ]);
    }
}
