<?php

namespace App\Http\Controllers;

use App\User;
use App\UserData;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createUser(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required'
        ]);
        $redirectUrl = 'FrontendController@index';
        if(Input::has('url')){
            $parts = explode("\\", Input::get('url'));
            if(count($parts) > 0) {
                $redirectUrl = $parts[count($parts) - 1];
            }
        }
        if ($v->fails()) {
            $request->session()->flash('modal', 'signup');
            return Redirect::action($redirectUrl)->withErrors($v->errors(), 'signup')->withInput();
        }

        $input = $request->all();

        $input['type'] = 'user';
        $input['password'] = bcrypt($input['password']);
        $user = new User();
        $user->fill($input);
        $user->save();

        $input['user_id'] = $user->id;
        $user_data = new UserData();
        $user_data->fill($input);
        $user_data->save();

        $request->session()->flash('modal', 'success-signup');
        return Redirect::action($redirectUrl)->withInput();
    }

    public function loginUser(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $redirectUrl = 'FrontendController@index';
        if(Input::has('url')){
            $parts = explode("\\", Input::get('url'));
            if(count($parts) > 0) {
                $redirectUrl = $parts[count($parts) - 1];
            }
        }
        if ($v->fails()) {
            $request->session()->flash('modal', 'login');
            return Redirect::action($redirectUrl)->withErrors($v->errors(), 'login')->withInput();
        }
    }
}
