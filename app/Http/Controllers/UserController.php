<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Images;
use App\Orders;
use App\PriceSchemes;
use App\Questions;
use App\Settings;
use App\User;
use App\UserConfirmation;
use App\UserData;
use App\UserSocial;
use App\Vouchers;
use Braintree\ClientToken;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;
use Braintree\Transaction;

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
            'email' => 'required|email|unique:users,email,0,local,local,1',
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

        Helpers::sendEmail('notifications.registration.confirmation.', $user->email, $user, ['user' => $user_data, 'key' => $key]);

        $request->session()->flash('modal', 'success-signup');

        return Redirect::action($this->getRoute())->withInput();
    }

    public function confirmation(Request $request, $key){
        $confirmation = UserConfirmation::where(['key' => $key])->first();
        $user = null;
        if($confirmation && !$confirmation->used){
            $confirmation->used = 1;
            $confirmation->save();
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

    function checkUserDetails($user){
        if(!$user->userData()->first()->weight || !$user->userData()->first()->height ||
            $user->userData()->first()->birth_date == '0000-00-00' || !$user->userData()->first()->gender){
            return false;
        } else {
            return true;
        }
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
        if($user = Auth::guard('user')->user()) {
            return Redirect::action('UserController@welcome');
        } else {
            return Redirect::action($this->getRoute());
        }
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
            return Redirect::action('UserController@welcome')->withInput();
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

    public function deleteQuestion($id){
        if($user = Auth::guard('user')->user()) {
            $question = Questions::findOrFail($id);
            if ($question && $question->user_id == $user->id) {
                $question->delete();
                Session::flash('flash_notification.question.message', 'The draft question was deleted!');
                Session::flash('flash_notification.question.level', 'success');
                return redirect()->action('FrontendController@questions', ['#drafts']);
            }
        }
        return Redirect::action('FrontendController@index');
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

            return redirect()->back()/*action('FrontendController@profile')*/;
        } else {
            return redirect()->action('FrontendController@index');
        }
    }

    function removeCurrentImage($question){
        if($current_image = $question->image()->first()){
            $old_file = base_path('public'.$current_image->path).$current_image->filename;
            if(File::exists($old_file)){
                File::delete($old_file);
            }
            $question->image_id = null;
            $question->save();
            return DB::table('images')->where(['id' => $current_image->id])->delete();
        } else {
            return false;
        }
    }

    public function updateQuestion(Request $request, $id)
    {
        if ($user = Auth::guard('user')->user()) {
            $question = Questions::findOrFail($id);
            $v = Validator::make($request->all(), [
                'question' => 'required|max:250',
                'image' => 'image|max:' . $this->max_filesize . '|mimes:jpeg,png'
            ]);
            $v->after(function ($v) use ($request) {
                if ($request->file('image') && $request->file('image')->getError()) {
                    $v->errors()->add('image', 'The image may not be greater than ' . $this->max_filesize . ' kilobytes.');
                }
            });
            if ($v->fails()) {
                $request->session()->flash('modal', 'question-database');
                return Redirect::action($this->getRoute())->withErrors($v->errors(), 'question_database')->withInput();
            }
            $input = $request->all();
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image')->getClientOriginalName();
                $parts = explode('.', $file);
                $extension = $parts[count($parts) - 1];
                $filename = $question->id . '_' . $user->id . '_' . date('TmdHis', time()) . '.' . $extension;
                $destinationPath = 'uploads/questions';
                $img = Image::make($request->file('image'));
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, $mode = 0775, true, true);
                }
                $this->removeCurrentImage($question);
                if($img->save($destinationPath . '/' . $filename, 90)){
                    $image = new Images();
                    $image->fill([
                        'path' => '/'.$destinationPath.'/',
                        'filename' => $filename
                    ]);
                    $image->save();
                    $question->image_id = $image->id;
                    $question->save();
                }
            } elseif ($input['cleared-image'] == 1) {
                $this->removeCurrentImage($question);
            }
            $question->question = $input['question'];
            $question->save();
            return Redirect::action('FrontendController@paymentQuestion', $question->id);
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function payment(Request $request, $id){
        $question = Questions::findOrFail($id);
        if($user = Auth::guard('user')->user()) {
            if ($request->has('payment_method_nonce')) {
                $price = Settings::where(['name' => 'question_price'])->first();
                $question_price = $price ? $price->value : env('DEFAULT_QUESTION_PRICE');
                $difference = $question_price - $user->points;
                $nonceFromTheClient = $request->get('payment_method_nonce');
                $order = new Orders();
                $data = [
                    'user_id' => $question->user()->first()->id,
                    'question_id' => $question->id,
                    'type' => 'question',
                    'price_scheme_id' => null,
                    'status' => 0,
                    'braintree_id' => ''
                ];
                $order->fill($data);
                $order->save();
                $result = Transaction::sale([
                    'amount' => $difference,
                    'customFields' => [
                        'order' => $order->id
                    ],
                    'options' => [
                        'submitForSettlement' => true
                    ],
                    'paymentMethodNonce' => $nonceFromTheClient
                ]);
                if ($result->success){
                    $changes['braintree_id'] = $result->transaction->id;
                    $changes['status'] = 1;
                    $order->fill($changes);
                    $order->save();
                    $user->points = $user->points - ($question_price - $difference);
                    $user->save();
                    $question->status = 1;
                    $question->save();
                    Session::flash('flash_notification.question.message', 'You payment was completed, please check your email for more info');
                    Session::flash('flash_notification.question.level', 'success');
                    return Redirect::action('FrontendController@questions');
                } else {
                    Session::flash('flash_notification.question.message', $result->message);
                    Session::flash('flash_notification.question.level', 'danger');
                    return Redirect::action('FrontendController@questions');
                }
            } else {
                return Redirect::action('FrontendController@profile');
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function pointsPayment(Request $request, $id){
        $question = Questions::findOrFail($id);
        if($user = Auth::guard('user')->user()){
            $price = Settings::where(['name' => 'question_price'])->first();
            $question_price = $price ? $price->value : env('DEFAULT_QUESTION_PRICE');
            $user->points = $user->points - $question_price;
            $user->save();
            $question->status = 1;
            $question->save();
            Session::flash('flash_notification.question.message', 'Your question has been submitted, please check your email for more info');
            Session::flash('flash_notification.question.level', 'success');
            return Redirect::action('FrontendController@questions');
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function welcome(){
        if($user = Auth::guard('user')->user()) {
            if($user->welcome) {
                if(session()->has('question.status') && session()->has('question.content') && session()->get('question.status') == 1){
                    return Redirect::action('FrontendController@authorizeQuestion');
                } elseif ($this->checkUserDetails($user)) {
                    return Redirect::action('FrontendController@questions');
                } else {
                    Session::flash('flash_notification.general.message', 'Please fill all the data so consultant could provide you with better answer');
                    Session::flash('flash_notification.general.level', 'warning');
                    return Redirect::action('FrontendController@profile');
                }
            } else {
                $user->welcome = 1;
                $user->save();
                return view('frontend/pages/welcome')->with([
                    'user' => $user
                ]);
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function paymentCredits(Request $request){
        $v = Validator::make($request->all(), [
            'scheme' => 'required'
        ]);
        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors())->withInput();
        }
        if($user = Auth::guard('user')->user()) {
            $scheme = PriceSchemes::findOrFail($request->get('scheme'));
            $creditCardToken = ClientToken::generate();
            return view('frontend/profile/payment-credits')->with([
                'user' => $user,
                'scheme' => $scheme,
                'token' => $creditCardToken
            ]);
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function checkoutCredits(Request $request, $id){
        $scheme = PriceSchemes::findOrFail($id);
        if($user = Auth::guard('user')->user()) {
            if ($request->has('payment_method_nonce')) {
                $nonceFromTheClient = $request->get('payment_method_nonce');
                $order = new Orders();
                $data = [
                    'user_id' => $user->id,
                    'question_id' => null,
                    'type' => 'credits',
                    'price_scheme_id' => $scheme->id,
                    'status' => 0,
                    'braintree_id' => ''
                ];
                $order->fill($data);
                $order->save();
                $result = Transaction::sale([
                    'amount' => $scheme->price,
                    'customFields' => [
                        'order' => $order->id
                    ],
                    'options' => [
                        'submitForSettlement' => true
                    ],
                    'paymentMethodNonce' => $nonceFromTheClient
                ]);
                if ($result->success){
                    $changes['braintree_id'] = $result->transaction->id;
                    $changes['status'] = 1;
                    $order->fill($changes);
                    $order->save();
                    $user->points = $user->points + $scheme->credits;
                    $user->save();
                    Session::flash('flash_notification.credits.message', 'The payment was completed. Your current balance is '.$user->points.' credits. Please check your email for details.');
                    Session::flash('flash_notification.credits.level', 'success');
                    return Redirect::action('FrontendController@credits');
                } else {
                    Session::flash('flash_notification.credits.message', $result->message);
                    Session::flash('flash_notification.credits.level', 'danger');
                    return Redirect::action('FrontendController@credits');
                }
            } else {
                return Redirect::action('FrontendController@profile');
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function payVoucher(Request $request){
        $v = Validator::make($request->all(), [
            'voucher_value' => 'required',
            'receiver_email' => 'required|max:255',
            'message' => 'max:500'
        ]);
        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors(), 'voucher')->withInput();
        }
        if($user = Auth::guard('user')->user()) {
            if($scheme = PriceSchemes::findOrFail($request->get('voucher_value'))) {
                $input = $request->all();
                $input['user_id'] = $user->id;
                $input['credits'] = $scheme->credits;
                $input['price'] = $scheme->price;
                if(array_key_exists('anonymous', $input) && $input['anonymous'] == 1){}else{
                    $input['anonymous'] = 0;
                }
                $input['status'] = 0;
                $input['code'] = bin2hex(random_bytes(4));
                $input['url_key'] = bin2hex(random_bytes(20));
                $voucher = new Vouchers();
                $voucher->fill($input);
                $voucher->save();
                return Redirect::action('UserController@formPaymentVoucher', ['id' => $voucher->id]);
            } else {
                Session::flash('flash_notification.voucher.message', 'There was some errors in your form, please try again or contact us');
                Session::flash('flash_notification.voucher.level', 'danger');
                return Redirect::action('FrontendController@buyVoucher');
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function formPaymentVoucher($id){
        $voucher = Vouchers::findOrFail($id);
        if($user = Auth::guard('user')->user()){
            $creditCardToken = ClientToken::generate();
            return view('frontend/profile/payment-voucher')->with([
                'user' => $user,
                'voucher' => $voucher,
                'token' => $creditCardToken
            ]);
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function checkoutVoucher(Request $request, $id){
        $voucher = Vouchers::findOrFail($id);
        if($user = Auth::guard('user')->user()) {
            if ($request->has('payment_method_nonce')) {
                $nonceFromTheClient = $request->get('payment_method_nonce');
                $order = new Orders();
                $data = [
                    'user_id' => $user->id,
                    'question_id' => null,
                    'type' => 'voucher',
                    'price_scheme_id' => null,
                    'voucher_id' => $voucher->id,
                    'status' => 0,
                    'braintree_id' => ''
                ];
                $order->fill($data);
                $order->save();
                $result = Transaction::sale([
                    'amount' => $voucher->price,
                    'customFields' => [
                        'order' => $order->id
                    ],
                    'options' => [
                        'submitForSettlement' => true
                    ],
                    'paymentMethodNonce' => $nonceFromTheClient
                ]);
                if ($result->success){
                    $changes['braintree_id'] = $result->transaction->id;
                    $changes['status'] = 1;
                    $order->fill($changes);
                    $order->save();
                    $voucher->status = 1;
                    $voucher->save();
                    Session::flash('flash_notification.general.message', 'You payment was completed, please check your email for more info');
                    Session::flash('flash_notification.general.level', 'success');
                    return Redirect::action('FrontendController@notifications');
                } else {
                    Session::flash('flash_notification.question.message', $result->message);
                    Session::flash('flash_notification.question.level', 'danger');
                    return Redirect::back();
                }
            } else {
                return Redirect::action('FrontendController@vouchers');
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function checkVoucher(Request $request){
        $v = Validator::make($request->all(), [
            'code' => 'required|max:10'
        ]);
        if ($v->fails()) {
            return Redirect::back()->withErrors($v->errors(), 'voucher')->withInput();
        }
        if($user = Auth::guard('user')->user()) {
            $voucher = Vouchers::where(['code' => $request->get('code'), 'status' => 1])->first();
            if ($voucher) {
                $voucher->status = 2;
                $voucher->save();
                $user->points = $user->points + $voucher->credits;
                $user->save();
                Session::flash('flash_notification.general.message', 'Congratulations! You hve successfully used your '.$voucher->credits.' credits gift voucher.');
                Session::flash('flash_notification.general.level', 'success');
                return Redirect::action('FrontendController@notifications');
            } else {
                Session::flash('flash_notification.voucher.message', 'You have entered wrong voucher number');
                Session::flash('flash_notification.voucher.level', 'danger');
                return Redirect::action('FrontendController@vouchers');
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }
}
