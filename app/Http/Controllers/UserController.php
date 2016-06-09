<?php

namespace App\Http\Controllers;

use App\User;
use App\UserConfirmation;
use App\UserData;
use App\UserSocial;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    private $max_filesize = 5120;

    function getRoute(){
        $redirectUrl = 'FrontendController@index';
        if(Input::has('url')){
            $parts = explode("\\", Input::get('url'));
            if(count($parts) > 0) {
                $redirectUrl = $parts[count($parts) - 1];
            }
        }
        return $redirectUrl;
    }

    public function createUser(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,0,local',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required'
        ]);
        if ($v->fails()) {
            $request->session()->flash('modal', 'signup');
            return Redirect::action($this->getRoute())->withErrors($v->errors(), 'signup')->withInput();
        }

        $input = $request->all();
        $input['local'] = 1;
        $input['status'] = 0;
        $input['password'] = bcrypt($input['password']);

        if($user = User::where(['email' => $input['email'], 'local' => 0, 'type' => 'user'])->first()){
            $user_data = UserData::where(['user_id' => $user->id])->first();
        } else {
            $input['type'] = 'user';
            $user = new User();
            $user_data = new UserData();
        }

        $user->fill($input);
        $user->save();
        $input['user_id'] = $user->id;

        $user_data->fill($input);
        $user_data->save();

        $key = md5($user->id . $user->email . time() . rand());
        $confirmation = new UserConfirmation();
        $confirmation->fill([
            'user_id' => $user->id,
            'key' => $key
        ]);
        $confirmation->save();

        Mail::send('emails.new_user', ['user' => $user_data, 'key' => $key], function ($message) use ($user) {
            $message->subject('Email confirmation link');
            $message->from('spwinwk@gmail.com', 'Style Sensei');
            $message->to($user->email);
            $message->priority('high');
        });

        $request->session()->flash('modal', 'success-signup');

        return Redirect::action($this->getRoute())->withInput();
    }

    public function confirmation(Request $request, $key){
        $confirmation = UserConfirmation::where(['key' => $key])->first();
        if($confirmation){
            $user = User::findOrFail($confirmation->user_id);
            $user->status = 1;
            $user->save();
            $request->request->add(['email' => $user->email]);
            $request->session()->flash('modal', 'confirmed');
        } else {
            $request->session()->flash('modal', 'not_confirmed');
        }
        if(session()->has('question.status') && session()->has('question.content') && session()->get('question.status') == 1){
            $action = 'FrontendController@authorizeQuestion';
        } else {
            $action = 'FrontendController@index';
        }
        return Redirect::action($action)->withInput();
    }

    public function loginUser(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($v->fails()) {
            $request->session()->flash('modal', 'login');
            return Redirect::action($this->getRoute())->withErrors($v->errors(), 'login')->withInput();
        }
        $auth = new AuthController();
        $auth->login($request, 'user');
        return Redirect::action($this->getRoute());
    }

    public function socialLogin($provider){
        if(!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist
        return Socialite::with($provider)->redirect();
    }

    function createNewUser($input){
        $input['status'] = 1;
        $input['local'] = 0;
        $input['type'] = 'user';
        $user = new User();
        $user->fill($input);
        $user->save();

        $input['user_id'] = $user->id;
        $user_data = new UserData();
        $user_data->fill($input);
        $user_data->save();

        return $user;
    }

    function getInput($user){
        $full_name = explode(' ', $user->getName());
        $input['first_name'] = $full_name[0];
        if(array_key_exists(1, $full_name)){
            $input['last_name'] = $full_name[1];
        }
        $input['email'] = $user->getEmail();
        return $input;
    }

    function createProvider($user_db, $provider, $soc_id){
        $input = array(
            'user_id' => $user_db->id,
            'provider' => $provider,
            'social_id' => $soc_id
        );
        $provider = new UserSocial();
        $provider->fill($input);
        $provider->save();
        return $provider;
    }

    function socialGetId($user){
        return $user->getId();
    }

    public function socialCallback($provider){
        if($user = Socialite::with($provider)->user()){
            $input = $this->getInput($user);
            if($user_db = User::where(['email' => $user->getEmail()])->first()){
                if($social_provider = $user_db->social()->where(['user_id' => $user_db->id, 'provider' => $provider])->first()){
                    $social_provider->social_id = $this->socialGetId($user);
                    $social_provider->save();
                } else {
                    $this->createProvider($user_db, $provider, $this->socialGetId($user)); // create provider for user
                }
            } else {
                $user_db = $this->createNewUser($input); // create user
                $this->createProvider($user_db, $provider, $this->socialGetId($user)); // create provider for user
            }
            Auth::guard('user')->login($user_db);
            return Redirect::action('FrontendController@authorizeQuestion')->withInput();
        }else{
            return 'something went wrong';
        }
    }

    public function questionCreate(Request $request){
        $v = Validator::make($request->all(), [
            'question' => 'required|max:250',
            'image' => 'image|max:'.$this->max_filesize.'|mimes:jpeg,png'
        ]);
        $v->after(function($v) use ($request) {
            if ($request->file('image') && $request->file('image')->getError()) {
                $v->errors()->add('image', 'The image may not be greater than '.$this->max_filesize.' kilobytes.');
            }
        });
        if ($v->fails()) {
            $request->session()->flash('modal', 'question');
            return Redirect::action($this->getRoute())->withErrors($v->errors(), 'question')->withInput();
        }
        $input = $request->all();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $destinationPath = 'uploads/session/temp/'.date('Y-m-d',time());
            $fileName = 'image_'.session()->getId().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            session()->put('question.image', date('Y-m-d',time()).'/'.$fileName);
        } elseif(!session()->has('question.image')) {
            session()->put('question.image', null);
        }
        session()->put('question.status', 1);
        session()->put('question.content', $input['question']);

        return Redirect::action('FrontendController@authorizeQuestion');
    }

    public function clearQuestion(){
        session()->forget('question');
        return json_encode('success');
    }

    public function clearImage(){
        session()->forget('question.image');
        return json_encode('success');
    }
}
