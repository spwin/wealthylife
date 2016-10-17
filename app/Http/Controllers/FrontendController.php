<?php

namespace App\Http\Controllers;

use App\Article;
use App\Discounts;
use App\Images;
use App\Notifications;
use App\OrderDrafts;
use App\PasswordResets;
use App\Phrases;
use App\PriceSchemes;
use App\Questions;
use App\Settings;
use App\User;
use App\UserData;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Braintree\ClientToken;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index(){
        /*$page = Cache::get('home');
        if($page != null){
            return $page;
        }*/
        $phrase = Phrases::where(['enabled' => 1])->inRandomOrder()->first();
        $videos = ['black-satin', 'accessories'];
        $view = view('frontend/pages/index')->with([
            'video' => $videos[array_rand($videos)],
            'phrase' => $phrase
        ])->render();

        //Cache::put('home', $view, 1200);
        return $view;
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
                $consultant = User::where(['type' => 'consultant'])->inRandomOrder()->first();
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
                return Redirect::action('FrontendController@checkoutQuestion', ['id' => $question->id]);
            } else {
                $question = array();
                $question['content'] = session()->get('question.content');
                $question['image_exists'] = session()->has('question.image') ? true : false;
                $question['image'] = session()->has('question.image') ? 'temp/300x300/'.session()->get('question.image') : 'images/avatars/no_image.png';
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

    public function checkoutQuestion($id){
        $question = Questions::where(['id' => $id])->first();
        if($question && $user = Auth::guard('user')->user()) {
            if($question->status == 0) {
                $price = Settings::where(['name' => 'question_price'])->first();
                $question_price = $price ? $price->value : env('DEFAULT_QUESTION_PRICE');
                $discount = Discounts::where(['user_id' => $user->id, 'used' => 0])->orderBy('created_at', 'DESC')->first();
                if($discount){
                    if($discount->type == 'percent'){
                        $discount->amount = round(($question_price/100)*$discount->percent);
                    } else {
                        $discount->amount = $discount->fixed;
                    }
                }
                return view('frontend/profile/checkout-question')->with([
                    'question_price' => $question_price,
                    'question' => $question,
                    'user' => $user,
                    'discount' => $discount
                ]);
            } else {
                return Redirect::action('FrontendController@questions');
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function paymentQuestion(Request $request, $id){
        $order_draft = OrderDrafts::where(['id' => $id, 'token' => $request->get('token')])->first();
        if($user = Auth::guard('user')->user()) {
            if ($order_draft && $question = Questions::where(['id' => $order_draft->question_id])->first()) {
                if ($question->status == 0) {
                    if($order_draft->to_pay > 0){
                        $creditCardToken = ClientToken::generate();
                        return view('frontend/profile/payment-question')->with([
                            'user' => $user,
                            'question' => $question,
                            'token' => $creditCardToken,
                            'user_balance' => $user->points,
                            'order_draft' => $order_draft
                        ]);
                    } else {
                        return view('frontend/profile/points-question')->with([
                            'user' => $user,
                            'question' => $question,
                            'user_balance' => $user->points,
                            'order_draft' => $order_draft
                        ]);
                    }
                }
            }
            Session::flash('flash_notification.question.message', 'Something went wrong with your order, try again or contact us');
            Session::flash('flash_notification.question.level', 'danger');
            return Redirect::action('FrontendController@questions', '#drafts');
        }
        return Redirect::action('FrontendController@index');
    }

    public function viewAnswer($id){
        if($user = Auth::guard('user')->user()) {
            $question = Questions::findOrFail($id);
            if($question && $question->status > 0) {
                $answer = $question->answer()->first();
                if ($answer) {
                    $answer->seen = 1;
                    $answer->save();
                }
                return view('frontend/profile/answer')->with([
                    'question' => $question,
                    'answer' => $answer,
                    'user' => $user
                ]);
            } else {
                return Redirect::action('FrontendController@questions');
            }
        } else {
            return Redirect::action('FrontendController@index');
        }
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
            $per_page = 15;
            $pending = $user->questions()->with('image')->where(['status' => 1])->orderBy('created_at', 'DESC')->paginate($per_page, ['*'], 'pending_page', null);
            $answered = $user->questions()->with('image')->where(['status' => 2])->orderBy('answered_at', 'DESC')->paginate($per_page, ['*'], 'answered_page', null);
            $drafts = $user->questions()->with('image')->where(['status' => 0])->orderBy('created_at', 'DESC')->paginate($per_page, ['*'], 'drafts_page', null);
            return view('frontend/profile/questions')->with([
                'user' => $user,
                'pending' => $pending,
                'answered' => $answered,
                'drafts' => $drafts
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function newArticle(){
        if($user = Auth::guard('user')->user()){
            $article = new Article();
            return view('frontend/profile/new-article')->with([
                'user' => $user,
                'article' => $article
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function articles(){
        if($user = Auth::guard('user')->user()){
            $per_page = 10;
            $articles = Article::where(['user_id' => $user->id])->get();
            $published = $user->articles()->with('image')->where(['status' => 3])->orderBy('published_at', 'DESC')->paginate($per_page, ['*'], 'published_page', null);
            $submitted = $user->articles()->with('image')->where(['status' => 1])->orWhere(['status' => 2])->orderBy('created_at', 'DESC')->paginate($per_page, ['*'], 'submitted_page', null);
            $drafts = $user->articles()->with('image')->where(['status' => 0])->orderBy('created_at', 'DESC')->paginate($per_page, ['*'], 'drafts_page', null);
            return view('frontend/profile/articles')->with([
                'user' => $user,
                'articles' => $articles,
                'published' => $published,
                'submitted' => $submitted,
                'drafts' => $drafts
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
            $priceSchemes = PriceSchemes::where(['type' => 'credits'])->get();
            return view('frontend/profile/credits')->with([
                'user' => $user,
                'schemes' => $priceSchemes
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
        $v->after(function($v) use ($request){
            if($request->get('birthday') || !$request->get('city')) {
                $v->errors()->add('birthday', 'Are you sure you are not a robot?');
            }
        });
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

        Mail::send(trans('notifications.contacts.form.email'), ['input' => $input], function ($message) use ($input, $general_mail) {
            $message->subject(trans('notifications.contacts.form.subject'));
            $message->from($input['email'], $input['name']);
            $message->to($general_mail->value);
            $message->priority('high');
        });

        Session::flash('flash_notification.general.message', 'Your message was successfully sent!');
        Session::flash('flash_notification.general.level', 'success');
        return Redirect::action('FrontendController@contacts');
    }

    public function about(){
        return view('frontend/pages/about-us')->with([]);
    }

    public function team(){
        return view('frontend/pages/team')->with([]);
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

    public function buyVoucher(Request $request){
        if($user = Auth::guard('user')->user()){
            $priceSchemes = PriceSchemes::where(['type' => 'vouchers'])->get();
            return view('frontend/profile/buy-voucher')->with([
                'user' => $user,
                'schemes' => $priceSchemes
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function sitemap(){
        $sitemap = App::make("sitemap");

        $sitemap->setCache('laravel.sitemap', 720);

        if (!$sitemap->isCached()) {
            $sitemap->add(URL::to('soon'), date('c', time()), '1.0', 'weekly');

            /*$sitemap->add(URL::to('/'), date('c', time()), '1.0', 'weekly');
            $sitemap->add(URL::action('FrontendController@blog'), date('c', time()), '1.0', 'daily');
            $sitemap->add(URL::action('FrontendController@about'), date('c', time()), '1.0', 'weekly');
            $sitemap->add(URL::action('FrontendController@team'), date('c', time()), '1.0', 'weekly');
            $sitemap->add(URL::action('FrontendController@contacts'), date('c', time()), '1.0', 'weekly');
            $sitemap->add(URL::action('FrontendController@privacy'), date('c', time()), '1.0', 'weekly');
            $sitemap->add(URL::action('FrontendController@terms'), date('c', time()), '1.0', 'weekly');

            $articles = Article::where(['status' => 3, 'reviewed' => 1])->orderBy('published_at', 'DESC')->get();
            foreach($articles as $article){
                $sitemap->add(URL::action('FrontendController@blogEntry', ['url' => $article->url]), date('c', time()), '1.0', 'weekly');
            }*/
        }
        return $sitemap->render('xml');
    }

    public function previewArticle($id){
        if($user = Auth::guard('user')->user()){
            $article = Article::findOrFail($id);
            return view('frontend/profile/preview-article')->with([
                'user' => $user,
                'article' => $article
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function editArticle($id){
        if($user = Auth::guard('user')->user()){
            $article = Article::findOrFail($id);
            return view('frontend/profile/edit-article')->with([
                'user' => $user,
                'article' => $article
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function blog(){
        $articles = Article::with('image')->whereNotNull('published_at')->where(['status' => 3, 'reviewed' => 1])->orderBy('published_at', 'DESC')->paginate(16);
        return view('frontend/pages/blog')->with([
            'articles' => $articles
        ]);
    }

    public function blogEntry($url){
        $article = Article::where(['url' => $url])->first();
        $article->visits = $article->visits + 1;
        $article->save();
        return view('frontend/pages/inner-blog')->with([
            'article' => $article
        ]);
    }

    public function passwordReset(){
        return view('frontend/pages/reset-password')->with([]);
    }

    public function newPassword($token = ''){
        if($token){
            $check = PasswordResets::where(['token' => $token])->first();
            if($check && $user = User::findOrFail($check->user_id)){
                return view('frontend/pages/new-password')->with([
                    'user' => $user
                ]);
            } else {
                abort(404);
            }
        }
        return Redirect::action('FrontendController@index');
    }

    public function changedPassword(){
        return view('frontend/pages/password-changed')->with([]);
    }

    public function referral(){
        if($user = Auth::guard('user')->user()){
            return view('frontend/profile/referral')->with([
                'user' => $user
            ]);
        }
        return Redirect::action('FrontendController@index');
    }

    public function acceptReferral(Request $request){
        $params = [];
        if($request->has('referral') && $request->has('key')){
            $referral = User::where(['id' => $request->get('referral'), 'referral_key' => $request->get('key')])->first();
            if($referral){
                session()->put('referral.user', $referral->id);
                session()->put('referral.key', $referral->referral_key);
            }
        }
        return Redirect::action('FrontendController@index', $params);
    }

    public function viewQuestion($id){
        $question = Questions::where(['id' => $id])->first();
        if($question && $user = Auth::guard('user')->user()){
            return view('frontend/profile/view-question')->with([
                'question' => $question,
                'user' => $user
            ]);
        } else {
            return Redirect::action('FrontendController@index');
        }
    }
}
