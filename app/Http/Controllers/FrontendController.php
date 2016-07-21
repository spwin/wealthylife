<?php

namespace App\Http\Controllers;

use App\Images;
use App\Questions;
use App\User;
use App\UserData;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Braintree\ClientToken;

class FrontendController extends Controller
{
    public function index(){
        $videos = ['market'];
        return view('frontend/pages/index')->with([
            'video' => $videos[array_rand($videos)]
        ]);
    }

    public function authorizeQuestion(Request $request){
        if(session()->has('question.content') && session()->has('question.status')) {
            if($user = Auth::guard('user')->user()){
                $question = new Questions();
                $data['user_id'] = $user->id;
                $data['question'] = session()->get('question.content');
                $data['status'] = 0;
                $data['ip'] = \Request::ip();
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
            return Redirect::action('FrontendController@index');
        }
    }

    public function paymentQuestion(Request $request, $id){
        $question = Questions::where(['id' => $id])->first();

        /*$customer = Auth::guard('user')->user()->subscription()->createStripeCustomer($request->stripe_token, [
            'email' => Auth::user()->email
        ]);

        Auth::user()->setStripeId($customer->id);
        Auth::user()->save();

        Auth::guard('user')->user()->charge(5000, ['currency' => 'cad', 'description' => 'A charge for something']);
        */

        $creditCardToken = ClientToken::generate();
        //$user = Auth::guard('user')->user();
        //$user->newSubscription('main', 'single')->create($creditCardToken);



        if($question) {
            return view('frontend/profile/payment-question')->with([
                'question' => $question,
                'token' => $creditCardToken
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

    public function messages(){
        if($user = Auth::guard('user')->user()){
            return view('frontend/profile/messages')->with([
                'user' => $user
            ]);
        }
        return Redirect::action('FrontendController@index');
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
}
