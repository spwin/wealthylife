<?php

namespace App\Http\Controllers;

use App\Images;
use App\User;
use App\UserData;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class AdminController extends Controller
{
    private $max_filesize = 1024;

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
        $input['type'] = 'admin';
        $input['password'] = bcrypt($input['password']);
        $user = new User();
        $user->fill($input);
        $user->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $destinationPath = 'images/avatars';
            $fileName = 'user'.$user->id.'-'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
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
                    $request->file('image')->move($destinationPath, $fileName);

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
        return view('admin/users/consultants/list')->with([
            'users' => $consultants
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
        $input['type'] = 'consultant';
        $input['password'] = bcrypt($input['password']);
        $user = new User();
        $user->fill($input);
        $user->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $destinationPath = 'images/avatars';
            $fileName = 'user'.$user->id.'-'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
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
                    $request->file('image')->move($destinationPath, $fileName);

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
}
