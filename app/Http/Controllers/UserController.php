<?php

namespace App\Http\Controllers;

use App\Images;
use App\User;
use App\UserConfirmation;
use App\UserData;
use App\UserSocial;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Intervention\Image\Facades\Image;
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
        $input['email_confirmed'] = 0;
        $input['password'] = bcrypt($input['password']);

        if($user = User::where(['email' => $input['email'], 'local' => 0, 'type' => 'user'])->first()){
            $input['status'] = 1;
            $user_data = UserData::where(['user_id' => $user->id])->first();
        } else {
            $input['status'] = 0;
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
            $user->email_confirmed = 1;
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

    function createNewUser($user_object, $input){
        $input['status'] = 1;
        $input['email_confirmed'] = 0;
        $input['local'] = 0;
        $input['type'] = 'user';
        $user = new User();
        $user->fill($input);
        $user->save();

        if(array_key_exists('gender', $user_object->user)) {
            $gender = $user_object->user['gender'];
            if($gender == 'male'){
                $input['gender'] = 'male';
            } elseif($gender == 'female'){
                $input['gender'] = 'female';
            }
        } else {
            $input['gender'] = null;
        }

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

    function downloadAvatar($user_db, $user, $provider){
        if($file = $user->getAvatar()) {
            if ($provider == 'google') {
                $file = str_replace('?sz=50', '', $file);
            } elseif ($provider == 'twitter') {
                $file = str_replace('_normal', '', $file);
            } elseif ($provider == 'facebook') {
                $file = str_replace('type=normal', 'type=large', $file);
            }
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $parts = explode('?', $ext);
            $extension = $parts[0];
            $fileName = 'user' . $user_db->id . '-' . $provider . '.' . $extension;
            $path = '/images/avatars/';
            $destination = base_path('public'.$path).$fileName;
            $img = Image::make($file);
            $img->fit(200, 200, function ($constraint) {
                $constraint->upsize();
            });
            if($img->save($destination, 90)){
                $image = new Images();
                $image->fill([
                    'path' => $path,
                    'filename' => $fileName
                ]);
                $image->save();
                DB::table('user_data')
                    ->where('id', $user_db->userData()->first()->id)
                    ->update(array('image_id' => $image->id));
            }
        }

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
                $user_db = $this->createNewUser($user, $input); // create user
                $this->createProvider($user_db, $provider, $this->socialGetId($user)); // create provider for user
                $this->downloadAvatar($user_db, $user, $provider);
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
            $img = Image::make($request->file('image'));
            if(!File::exists($destinationPath)){
                File::makeDirectory($destinationPath, $mode = 0775, true, true);
            }
            $img->save($destinationPath.'/'.$fileName, 90);
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

    public function updateProfileLogin(Request $request, $id, $type){
        if($id == Auth::guard('user')->user()->id) {
            $user = User::where(['id' => $id])->first();
            $info = $request->all();
            if ($type == 'email') {
                $v = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users,email,' . $user->email . ',email',
                ]);
                if ($v->fails()) {
                    return redirect()->action('FrontendController@profile', ['#login'])->withErrors($v->errors(), 'email');
                }
                if ($request->get('email') == $user->email) {
                    Session::flash('flash_notification.login.message', 'Email address remains the same');
                    Session::flash('flash_notification.login.level', 'warning');
                } else {
                    $user->email = $info['email'];
                    Session::flash('flash_notification.login.message', 'Email has been successfully changed');
                    Session::flash('flash_notification.login.level', 'success');
                }
            } elseif ($type == 'pass') {
                $v = Validator::make($request->all(), [
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6'
                ]);
                if ($v->fails()) {
                    return redirect()->action('FrontendController@profile', ['#login'])->withErrors($v->errors(), 'password');
                }
                $user->password = bcrypt($info['password']);
                if($user->local == 0){
                    $user->local = 1;
                    $user->email_confirmed = 1;
                }
                Session::flash('flash_notification.login.message', 'Password has been successfully changed');
                Session::flash('flash_notification.login.level', 'success');
            }
            $user->save();
            return Redirect::action('FrontendController@profile', ['#login']);
        } else {
            Session::flash('flash_notification.login.message', 'You can edit only your information');
            Session::flash('flash_notification.login.level', 'danger');
            return redirect()->action('FrontendController@profile', ['#login']);
        }
    }

    function validateDate($format, $date, $day, $month, $year)
    {
        $validates = false;
        $d = \DateTime::createFromFormat($format, $date);
        if($d && $d->format($format) === $date){
            if((int)$day <= cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year)){
                $validates = true;
            }
        }
        return $validates;
    }

    public function updateProfileGeneral(Request $request, $id){
        $user = User::where(['id' => $id])->first();
        if(count($user) > 0 && $user->id == Auth::guard('user')->user()->id){
            $user_data = UserData::where(['user_id' => $user->id])->first();
            if(count($user_data) > 0) {
                $v = Validator::make($request->all(), [
                    'first_name' => 'required|alpha_num',
                    'last_name' => 'required|alpha_num',
                    'gender' => 'required',
                    'about' => 'max: 500',
                    'height' => 'numeric|min: 20|max: 300',
                    'weight' => 'numeric|min: 20|max: 500'
                ]);
                $day = $request->get('bd-day');
                $month = $request->get('bd-month');
                $year = $request->get('bd-year') < 1900 ? '0000' : $request->get('bd-year');
                $date = $year.'-'.$month.'-'.$day;
                $v->after(function($v) use ($day, $month, $year) {
                    $date = $day.'/'.$month.'/'.$year;
                    if($day != '00' || $month != '00' || $year != '0000'){
                        if($day != '00' && $month != '00' && $year != '0000') {
                            if ($this->validateDate('d/m/Y', $date, $day, $month, $year) == false) {
                                $v->errors()->add('birth_date', date('F', mktime(0, 0, 0, (int)$month, 10)).', '.$year.' has only ' . cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year) . ' days.');
                            }
                        } else {
                            $v->errors()->add('birth_date', 'Date of birth field is incorrect.');
                        }
                    }
                });
                if ($v->fails()) {
                    $request->merge([
                        'first_name' => $user_data->first_name,
                        'last_name' => $user_data->last_name,
                        'height' => $user_data->height,
                        'weight' => $user_data->weight,
                    ]);
                    return redirect()->action('FrontendController@profile')->withInput()->withErrors($v->errors(), 'general');
                }
                $input = $request->all();
                $input['birth_date'] = $date;
                if($input['height'] == '') $input['height'] = null;
                if($input['weight'] == '') $input['weight'] = null;
                $user_data->fill($input);
                $user_data->save();
                Session::flash('flash_notification.general.message', 'You profile information has been updated.');
                Session::flash('flash_notification.general.level', 'success');
                return redirect()->action('FrontendController@profile');
            }
        }
        return redirect()->action('FrontendController@index');
    }

    public function changeAvatar(Request $request){
        $userData = UserData::where(['user_id' => Auth::guard('user')->user()->id])->first();
        if($userData) {
            $v = Validator::make($request->all(), [
                'avatar' => 'image|max:' . $this->max_filesize . '|mimes:jpeg,png'
            ]);
            $v->after(function ($v) use ($request) {
                if ($request->file('avatar') && $request->file('avatar')->getError()) {
                    $v->errors()->add('avatar', 'The image may not be greater than ' . $this->max_filesize . ' kilobytes.');
                }
            });
            if ($v->fails()) {
                $request->session()->flash('modal', 'avatar');
                return Redirect::action($this->getRoute())->withErrors($v->errors(), 'avatar')->withInput();
            }

            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                $destinationPath = 'images/avatars';
                $fileName = 'user' . Auth::guard('user')->user()->id . '-' . $request->file('avatar')->getClientOriginalName();
                $img = Image::make($request->file('avatar'));
                $img->save($destinationPath . '/original/' . $fileName, 90);
                $img->fit(200, 200, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($destinationPath . '/' . $fileName, 90);
                $input['filename'] = $fileName;
            } else {
                $input['filename'] = 'no_image.png';
            }

            $input['path'] = '/images/avatars/';
            $image = new Images();
            $image->fill($input);
            $image->save();

            $userData->image_id = $image->id;
            $userData->save();

            return redirect()->action('FrontendController@profile');
        } else {
            return redirect()->action('FrontendController@index');
        }
    }
}
