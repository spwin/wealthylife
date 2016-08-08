<?php

namespace App\Http\Controllers;

use App\Images;
use App\Notifications;
use App\Questions;
use App\Settings;
use App\User;
use App\UserData;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Braintree\ClientToken;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index(){
        $videos = ['market', 'tree', 'yoga', 'sky', 'bike'];
        return view('frontend/pages/index')->with([
            'video' => $videos[array_rand($videos)]
        ]);
    }

    function getRegionByIp($data){
        $data['country'] = '';
        $data['region'] = '';
        if(array_key_exists('ip', $data)) {
            //Load the class
            $ipLite = new ip2location;
            $ipLite->setKey(env('IP_LOCATION_API_KEY'));

            //Get errors and locations
            $locations = $ipLite->getCity($data['ip']);

            $data['country'] = $locations['countryName'];
            $data['region'] = $locations['regionName'];
        }
    }

    function checkUserDetails(){
        if($user = Auth::guard('user')->user()){
            if(!$user->userData()->first()->weight || !$user->userData()->first()->height ||
                $user->userData()->first()->birth_date == '0000-00-00' || !$user->userData()->first()->gender){
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function authorizeQuestion(Request $request){
        if(session()->has('question.content') && session()->has('question.status')) {
            if($user = Auth::guard('user')->user()){
                $question = new Questions();
                $data['user_id'] = $user->id;
                $data['question'] = session()->get('question.content');
                $data['status'] = 0;
                $data['ip'] = \Request::ip();
                $consultant = User::where(['type' => 'consultant'])->orderByRaw("RAND()")->first();
                $data['consultant_id'] = $consultant ? $consultant->id : 1;
                //$this->getRegionByIp($data);
                $question->fill($data);
                $question->save();
                if (session()->has('question.image') && $file = session()->get('question.image'))
                {
                    $file = base_path('public/uploads/session/temp/').$file;
                    $parts = explode('.',$file);
                    $extension = $parts[count($parts)-1];
                    $filename = $question->id.'_'.$user->id.'_'.date('TmdHis', time()).'.'.$extension;
                    $path = '/uploads/questions/';
                    $destination = base_path('public'.$path).$filename;
                    if(File::copy($file, $destination)){
                        $image = new Images();
                        $image->fill([
                            'path' => $path,
                            'filename' => $filename
                        ]);
                        $image->save();
                        $question->image_id = $image->id;
                        $question->save();
                        Storage::delete($file);
                    }
                }
                session()->forget('question');
                return Redirect::action('FrontendController@paymentQuestion', ['id' => $question->id]);
            } else {
                $question = array();
                $question['content'] = session()->get('question.content');
                $question['image'] = session()->has('question.image') ? 'uploads/session/temp/'.session()->get('question.image') : 'images/avatars/no_image.png';
                $question['status'] = session()->get('question.status');
                return view('frontend/pages/authorize-question')->with([
                    'question' => $question
                ]);
            }
        } else {
            //$request->session()->flash('modal', 'question');
            if($this->checkUserDetails()){
                return Redirect::action('FrontendController@index');
            } else {
                Session::flash('flash_notification.general.message', 'Please fill all the data so consultant could provide you with better answer');
                Session::flash('flash_notification.general.level', 'warning');
                return Redirect::action('FrontendController@profile');
            }
        }
    }

    public function paymentQuestion(Request $request, $id){
        $question = Questions::where(['id' => $id])->first();
        if($question && $user = Auth::guard('user')->user()) {
            if($question->status == 0) {
                $price = Settings::where(['name' => 'question_price'])->first();
                $question_price = $price ? $price->value : env('DEFAULT_QUESTION_PRICE');
                $difference = $question_price - $user->points;
                if ($user->points >= $question_price) {
                    return view('frontend/profile/points-question')->with([
                        'question' => $question,
                        'user_balance' => $user->points,
                        'question_price' => $question_price,
                        'difference' => $difference
                    ]);
                } else {
                    $creditCardToken = ClientToken::generate();
                    return view('frontend/profile/payment-question')->with([
                        'question' => $question,
                        'token' => $creditCardToken,
                        'user_balance' => $user->points,
                        'question_price' => $question_price,
                        'difference' => $difference
                    ]);
                }
            } else {
                return Redirect::action('FrontendController@questions');
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function viewAnswer($id){
        if($user = Auth::guard('user')->user()) {
            $question = Questions::findOrFail($id);
            $answer = $question->answer()->first();
            $answer->seen = 1;
            $answer->save();
            return view('frontend/profile/answer')->with([
                'question' => $question,
                'answer' => $answer,
                'user' => $user
            ]);
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function blog(){
        return view('frontend/pages/blog')->with([

        ]);
    }

    function getBirthDate($date){
        list($year, $month, $day) = explode('-', $date);
        return ['year' => $year, 'month' => $month, 'day' => $day];
    }

    public function profile(){
        if($user = Auth::guard('user')->user()){
            $user_data = UserData::where(['user_id' => $user->id])->first();
            return view('frontend/profile/index')->with([
                'user' => $user,
                'user_data' => $user_data,
                'bd' => $this->getBirthDate($user_data->birth_date)
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function notifications(){
        if($user = Auth::guard('user')->user()){
            return view('frontend/profile/notifications')->with([
                'user' => $user
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function showNotification($id){
        $notification = Notifications::findOrFail($id);
        if($user = Auth::guard('user')->user()) {
            if ($user->id == $notification->user()->first()->id) {
                $notification->seen = 1;
                $notification->save();
                return view('frontend/profile/notification')->with([
                    'notification' => $notification,
                    'user' => $user
                ]);
            } else {
                return Redirect::back();
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function questions(){
        if($user = Auth::guard('user')->user()){
            return view('frontend/profile/questions')->with([
                'user' => $user
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function articles(){
        if($user = Auth::guard('user')->user()){
            return view('frontend/profile/articles')->with([
                'user' => $user
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function vouchers(){
        if($user = Auth::guard('user')->user()){
            return view('frontend/profile/vouchers')->with([
                'user' => $user
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function credits(){
        if($user = Auth::guard('user')->user()){
            return view('frontend/profile/credits')->with([
                'user' => $user
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function contacts(){
        return view('frontend/pages/contacts')->with([

        ]);
    }

    public function contactForm(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'max:100',
            'message' => 'required|max:1000'
        ]);
        if ($v->fails()) {
            return Redirect::action('FrontendController@contacts')->withErrors($v->errors(), 'contacts')->withInput();
        }
        $input = $request->all();
        if(!array_key_exists('name', $input)){
            $input['name'] = 'Visitor';
        } elseif(!$input['name']){
            $input['name'] = 'Visitor';
        }
        $general_mail = Settings::where(['name' => 'email'])->first();
        Mail::send('emails.contacts', ['input' => $input], function ($message) use ($input, $general_mail) {
            $message->subject('StyleSensei Contact Form message');
            $message->from($input['email'], $input['name']);
            $message->to($general_mail->value);
            $message->priority('high');
        });
        Session::flash('flash_notification.general.message', 'Your message was successfully sent!');
        Session::flash('flash_notification.general.level', 'success');
        return Redirect::action('FrontendController@contacts');
    }

    public function services(){
        return view('frontend/pages/services')->with([]);
    }

    public function about(){
        return view('frontend/pages/about')->with([]);
    }

    public function privacy(){
        return view('frontend/pages/privacy')->with([]);
    }

    public function terms(){
        return view('frontend/pages/terms')->with([]);
    }

    public function soon(){
        return view('frontend/pages/soon')->with([]);
    }
}
