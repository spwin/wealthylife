<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Article;
use App\Images;
use App\Payroll;
use App\Questions;
use App\Settings;
use App\User;
use App\UserData;
use App\Helpers\Helpers;
use App\Helpers\consultantSlot;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class ConsultantController extends Controller
{
    function getDailyQuestions($consultant, $last_x_days){
        $date = new \DateTime('tomorrow -'.$last_x_days.' days');
        $days = Questions::select(array(
            DB::raw('DATE(`asked_at`) as `date`'),
            DB::raw('COUNT(*) as `count`')
        ))
            ->where(['consultant_id' => $consultant->id])
            ->where('status', '>=', 1)
            ->where('created_at', '>', $date)
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->lists('count', 'date');
        $result = array();
        $tomorrow = new \DateTime('tomorrow');
        while($date < $tomorrow){
            $result[date('Y-m-d', $date->getTimestamp())] = [
                'day' => date('d M', $date->getTimestamp()),
                'questions' => 0
            ];
            $date->modify('+1 day');
        }
        if(count($days) > 0){
            foreach($days as $date => $count){
                $result[$date]['questions'] = $count;
            }
        }

        $organised = array();
        foreach($result as $res){
            $organised['labels'][] = $res['day'];
            $organised['values'][] = $res['questions'];
        }

        return $organised;
    }

    function getDashboardSummary($answers){
        $summary = new \stdClass();
        $total_time = 0;
        foreach($answers as $answer){
            $total_time += $answer->question->timer;
        }
        $summary->average_answer_time = ($count = count($answers)) > 0 ? floor(($total_time / $count)/60) : 0;
        return $summary;
    }

    function getTimetable($user){
        $timetable = null;
        $consultant_time = false;
        if($user){
            $timetable = json_decode($user->timetable);
            $slots = array();
            $mins_per_day = 1440;
            $percent_min = $mins_per_day/100;
            $total_consultant = 0;
            $totals = array();
            $day = strtolower(date('D'));
            $times = $timetable->$day;
            $first = true;
            $count = 0;
            $total_day = 0;
            if(count($times) > 0){
                foreach($times as $time){
                    if($first){
                        $this->createSlot($slots[$day], $this->hoursToMins($time->from), 'empty', $percent_min, 0, $time->from);
                        $first = false;
                    }
                    $mins = $this->hoursToMins($time->to) - $this->hoursToMins($time->from);
                    $this->createSlot($slots[$day], $mins, 'busy', $percent_min, $time->from, $time->to);
                    $total_day += $mins;
                    $count++;
                    if(count($times) == $count){
                        $this->createSlot($slots[$day], $mins_per_day - $this->hoursToMins($times[count($times) - 1]->to), 'empty', $percent_min, $times[count($times) - 1]->to, '24:00');
                    } else {
                        $this->createSlot($slots[$day], $this->hoursToMins($times[$count]->from) - $this->hoursToMins($time->to), 'empty', $percent_min, $times[$count]->from, $time->to);
                    }

                }
            } else {
                $slots[$day][] = ['amount' => 100, 'type' => 'empty', 'tooltip' => '0:00 - 24:00'];
            }
            $totals[$day] = $this->formatFromMins($total_day);
            $total_consultant += $total_day;
            $consultant_time = ['slots' => $slots, 'totals' => $totals, 'total' => $this->formatFromMins($total_consultant)];
        }
        return $consultant_time;
    }

    public function index(){
        $consultant = Auth::guard('consultant')->user();
        $payroll = Payroll::where(['current' => 1])->first();
        $answers = Answers::where(['payroll_id' => $payroll->id, 'consultant_id' => $consultant->id])->get();
        $users = User::where(['type' => 'user'])->where('created_at', '>', $payroll->starts_at)->get();
        $latest_users = User::where(['type' => 'user'])->orderBy('created_at', 'DESC')->limit(5)->get();
        $latest_answered = Questions::where(['consultant_id' => $consultant->id, 'status' => 2])->orderBy('answered_at', 'DESC')->limit(5)->get();
        $latest_rated = Answers::where(['consultant_id' => $consultant->id, 'rated' => 1])->orderBy('updated_at', 'DESC')->limit(5)->get();
        $pending = Questions::where(['status' => 1, 'consultant_id' => $consultant->id])->whereNotNull('user_id')->get();
        $gross_consultant = Settings::select('value')->where(['name' => 'gross_consultant'])->first();
        $summary = $this->getDashboardSummary($answers);
        $daily_questions = $this->getDailyQuestions($consultant, 30);
        $timetable = $this->getTimetable($consultant);
        $rating = $consultant->answers()->where(['answers.rated' => 1])->where('answers.rating', '>', 0)->avg('rating');
        $articles = Article::where(['user_id' => $consultant->id])->where('published_at', '>', $payroll->starts_at)->get();
        return view('consultant/dashboard/dashboard')->with([
            'payroll' => $payroll,
            'consultant' => $consultant,
            'answers' => $answers,
            'gross_consultant' => $gross_consultant->value,
            'summary' => $summary,
            'users' => $users,
            'daily_questions' => $daily_questions,
            'pending' => $pending,
            'latest_users' => $latest_users,
            'timetable' => $timetable,
            'latest_answered' => $latest_answered,
            'latest_rated' => $latest_rated,
            'rating' => round($rating, 2),
            'articles' => $articles
        ]);
    }

    public function login(){
        return view('consultant/login');
    }

    function hoursToMins($hours){
        $parts = explode(':', $hours);
        return $parts[0]*60+$parts[1];
    }

    function createSlot(&$slots, $mins, $type, $percent, $from, $to){
        if($mins > 0) {
            $slot = [
                'amount' => floor($mins * 100 / $percent)/100,
                'type' => $type,
                'tooltip' => $from.' - '.$to
            ];
            $slots[] = $slot;
        }
    }

    function formatFromMins($total){
        $hours = floor($total/60);
        return $hours.'h '.($total - $hours * 60).'min';
    }

    public function timetable(){
        $days_matcher = [
            'mon' => 'Monday',
            'tue' => 'Tuesday',
            'wed' => 'Wednesday',
            'thu' => 'Thursday',
            'fri' => 'Friday',
            'sat' => 'Saturday',
            'sun' => 'Sunday'
        ];

        $timetable = null;
        $consultant_time = false;
        if($user = Auth::guard('consultant')->user()){
            $timetable = json_decode($user->timetable);
            $slots = array();
            $mins_per_day = 1440;
            $percent_min = $mins_per_day/100;
            $total_consultant = 0;
            $totals = array();
            foreach($timetable as $day => $times){
                $first = true;
                $count = 0;
                $total_day = 0;
                if(count($times) > 0){
                    foreach($times as $time){
                        if($first){
                            $this->createSlot($slots[$day], $this->hoursToMins($time->from), 'empty', $percent_min, 0, $time->from);
                            $first = false;
                        }
                        $mins = $this->hoursToMins($time->to) - $this->hoursToMins($time->from);
                        $this->createSlot($slots[$day], $mins, 'busy', $percent_min, $time->from, $time->to);
                        $total_day += $mins;
                        $count++;
                        if(count($times) == $count){
                            $this->createSlot($slots[$day], $mins_per_day - $this->hoursToMins($times[count($times) - 1]->to), 'empty', $percent_min, $times[count($times) - 1]->to, $mins_per_day);
                        } else {
                            $this->createSlot($slots[$day], $this->hoursToMins($times[$count]->from) - $this->hoursToMins($time->to), 'empty', $percent_min, $times[$count]->from, $time->to);
                        }

                    }
                } else {
                    $slots[$day][] = ['amount' => 100, 'type' => 'empty', 'tooltip' => '0:00 - 24:00'];
                }
                $totals[$day] = $this->formatFromMins($total_day);
                $total_consultant += $total_day;
            }
            $consultant_time = ['slots' => $slots, 'totals' => $totals, 'total' => $this->formatFromMins($total_consultant)];
        }

        return view('consultant/timetable/timetable')->with([
            'matcher' => $days_matcher,
            'timetable' => $consultant_time
        ]);
    }

    public function listUsers(Request $request){
        $key = '';
        if($request->has('search') && $search = strtolower($request->get('search'))){
            $key = $search;
            $users = User::with('userData')->where(['type' => 'user'])->whereHas('userData', function($q) use($search)
            {
                $q->whereRaw('LOWER(first_name) LIKE ?', array('%'.$search.'%'));
                $q->orWhereRaw('LOWER(last_name) LIKE ?', array('%'.$search.'%'));
                $q->orWhereRaw('LOWER(email) LIKE ?', array('%'.$search.'%'));

            })->orderBy('users.created_at', 'DESC')->get();
        } else {
            $users = User::with('userData')->where(['type' => 'user'])->orderBy('created_at', 'DESC')->get();
        }
        return view('consultant/users/list')->with([
            'users' => $users,
            'search' => $key
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
        $user_data = UserData::where(['user_id' => $user->id])->first();
        $econf = $this->getEmailConfirmation($user);
        return view('consultant/users/profile')->with([
            'user' => $user,
            'user_data' => $user_data,
            'econf' => $econf,
            'consultant' => Auth::guard('consultant')->user()
        ]);
    }

    public function listPending(Request $request){
        $consultant = Auth::guard('consultant')->user();
        $key = '';
        if($request->has('search') && $search = strtolower($request->get('search'))){
            $key = $search;
            $questions = Questions::where(['status' => 1, 'consultant_id' => $consultant->id])->whereNotNull('user_id')
                ->whereRaw('LOWER(question) LIKE ?', array('%'.$search.'%'))->orderBy('asked_at', 'ASC')->paginate(20);
        } else {
            $questions = Questions::where(['status' => 1, 'consultant_id' => $consultant->id])->whereNotNull('user_id')->orderBy('asked_at', 'ASC')->paginate(20);
        }
        $routes = ['1' => 'listPending', '2' => 'listAnswered', '3' => 'listRejected'];
        return view('consultant/questions/list')->with([
            'questions' => $questions,
            'status' => 'Pending',
            'stat' => 1,
            'routes' => $routes,
            'search' => $key
        ]);
    }

    public function listAnswered(Request $request){
        $consultant = Auth::guard('consultant')->user();
        $key = '';
        if($request->has('search') && $search = strtolower($request->get('search'))){
            $key = $search;
            $questions = Questions::where(['status' => 2, 'consultant_id' => $consultant->id])
                ->whereRaw('LOWER(question) LIKE ?', array('%'.$search.'%'))->orderBy('asked_at', 'ASC')->paginate(20);
        } else {
            $questions = Questions::where(['status' => 2, 'consultant_id' => $consultant->id])->orderBy('asked_at', 'DESC')->paginate(20);
        }
        $routes = ['1' => 'listPending', '2' => 'listAnswered', '3' => 'listRejected'];
        return view('consultant/questions/list')->with([
            'questions' => $questions,
            'status' => 'Answered',
            'stat' => 2,
            'routes' => $routes,
            'search' => $key
        ]);
    }

    public function listRejected(Request $request){
        $consultant = Auth::guard('consultant')->user();
        $key = '';
        if($request->has('search') && $search = strtolower($request->get('search'))){
            $key = $search;
            $questions = Questions::where(['status' => 3, 'consultant_id' => $consultant->id])
                ->whereRaw('LOWER(question) LIKE ?', array('%'.$search.'%'))->orderBy('asked_at', 'ASC')->paginate(20);
        } else {
            $questions = Questions::where(['status' => 3, 'consultant_id' => $consultant->id])->orderBy('asked_at', 'DESC')->paginate(20);
        }
        $routes = ['1' => 'listPending', '2' => 'listAnswered', '3' => 'listRejected'];
        return view('consultant/questions/list')->with([
            'questions' => $questions,
            'status' => 'Rejected',
            'stat' => 3,
            'routes' => $routes,
            'search' => $key
        ]);
    }

    public function answerQuestion($id){
        $question = Questions::findOrFail($id);
        return view('consultant/questions/answer')->with([
            'question' => $question,
            'user' => $question->user()->first()
        ]);
    }

    public function answerSave(Request $request, $id){
        $question = Questions::findOrFail($id);
        $question->timer = $request->get('timer');
        $question->save();
        $input = $request->all();
        $data = [];
        $data['answer'] = $input['answer'];
        $data['ip'] = \Request::ip();
        $data['seen'] = 0;
        $data['question_id'] = $question->id;
        $data['consultant_id'] = Auth::guard('consultant')->user()->id;
        $answer = Answers::firstOrNew(array('question_id' => $id));
        $answer->fill($data);
        $answer->save();
        return Redirect::action('ConsultantController@answerPreview', ['id' => $answer->id]);
    }

    public function answerPreview($id){
        $answer = Answers::findOrFail($id);
        return view('consultant/questions/preview')->with([
            'answer' => $answer,
            'question' => $answer->question()->first()
        ]);
    }

    public function rejectionPreview($id){
        $question = Questions::findOrFail($id);
        return view('consultant/questions/rejection')->with([
            'question' => $question
        ]);
    }

    public function answerSend($id){
        $answer = Answers::findOrFail($id);
        $current = Payroll::where(['current' => 1])->first();
        $answer->payroll_id = $current->id;
        $answer->save();
        $question = $answer->question()->first();
        $question->answered_at = date('Y-m-d H:i:s', time());
        $question->status = 2;
        $question->save();
        Helpers::sendEmail('notifications.question.answered.', $question->user->email, $question->user, ['user' => $question->user->userData, 'question' => $question]);
        return Redirect::action('ConsultantController@interactiveAnswer');
    }

    public function ajaxPending(Request $request){
        $pending = 0;
        if($user = Auth::guard('consultant')->user()){
            $pending = Questions::where(['consultant_id' => $user->id, 'status' => 1])->count();
        }
        return json_encode(['pending' => $pending]);
    }

    public function saveTimer(Request $request, $id){
        $time = 0;
        if($request->has('time') && ($user = Auth::guard('consultant')->user())){
            $time = intval($request->get('time'));
            DB::table('questions')->where('id', $id)->update(array('timer' => $time));
        }
        $input = $request->all();
        $data = [];
        $data['answer'] = $input['answer'];
        $data['ip'] = \Request::ip();
        $data['seen'] = 0;
        $data['question_id'] = $id;
        $data['consultant_id'] = Auth::guard('consultant')->user()->id;
        $answer = Answers::firstOrNew(array('question_id' => $id));
        $answer->fill($data);
        $answer->save();
        return json_encode(array(
            'date' => date('H:i:s'),
            'status' => 'success'
        ));
    }

    public function rejectQuestion(Request $request, $id){
        $question = Questions::findOrFail($id);
        $reason = $request->get('reason');
        $question->rejection = $reason;
        $question->status = 3;
        $question->save();
        if($user = User::findOrFail($question->user_id)){
            $price = Settings::select('value')->where(['name' => 'question_price'])->first();
            $user->points = $user->points + $price->value;
            $user->save();
            Helpers::sendEmail('notifications.question.rejected.', $question->user->email, $question->user, ['user' => $question->user->userData, 'question' => $question]);
            //Helpers::sendNotification('notifications.question.rejected.', $user, ['reason' => $reason, 'credits' => $price->value, 'link' => action('FrontendController@viewAnswer', ['id' => $question->id])]);
        }
        Flash::warning('The question was rejected and credits were returned to user');
        return Redirect::action('ConsultantController@interactiveAnswer');
    }

    public function articles(){
        $user = Auth::guard('consultant')->user();
        $articles = Article::where(['user_id' => $user->id])->get();
        return view('consultant/articles/index')->with([
            'articles' => $articles
        ]);
    }

    public function createArticle(){
        $article = new Article();
        return view('consultant/articles/create')->with([
            'article' => $article
        ]);
    }

    public function editArticle($id){
        $article = Article::findOrFail($id);
        $image_url = url()->to('/').'/'.$article->image->path.$article->image->filename;
        return view('consultant/articles/edit')->with([
            'article' => $article,
            'image_url' => $image_url
        ]);
    }

    public function previewArticle($url){
        $article = Article::with('image')->where(['url' => $url])->first();
        return view('frontend/pages/preview-inner-blog')->with([
            'article' => $article
        ]);
    }

    public function updateArticle(Request $request, $id){
        if($user = Auth::guard('consultant')->user() && $article = Article::find($id)) {
            if($request->has('save')) {
                $input = $request->all();

                $v = Validator::make($request->all(), [
                    'title' => 'required|max:255',
                    'content' => 'required'
                ]);
                $v->after(function ($v) use ($request, &$input) {
                    if ($request->has('image_url')) {
                        $image_id = $this->createImage($request->get('image_url'));
                        if ($image_id) {
                            $input['image_id'] = $image_id;
                        } else {
                            $v->errors()->add('image_url', 'Image not found');
                        }
                    }
                });
                if ($v->fails()) {
                    return Redirect::back()->withErrors($v->errors())->withInput();
                }

                $input['hide_name'] = $request->has('hide_name') ? 1 : 0;
                $input['hide_email'] = $request->has('hide_email') ? 1 : 0;
                $input['disable_comments'] = $request->has('disable_comments') ? 1 : 0;

                $article->fill($input);
                $article->save();

                Flash::success('Article has been saved');
            } elseif($request->has('publish')){
                $article->status = 3;
                $article->published_at = date('Y-m-d H:i:s', time());
                $article->save();
                Flash::success('Article has been successfully published');
            } elseif($request->has('unpublish')){
                $article->status = 1;
                $article->save();
                Flash::success('Article has been unpublished');
            }
            return Redirect::action('ConsultantController@editArticle', ['id' => $article->id]);
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    public function createImage($image){
        $id = null;
        $url_parts = explode('/', $image);
        $url_parts = array_slice($url_parts, 3);

        $filename = end($url_parts);
        $full_path = implode('/',$url_parts);

        array_pop($url_parts);
        $path = '/'.implode('/',$url_parts).'/';

        if(file_exists(public_path($full_path))){
            $image = new Images();
            $image->fill([
                'filename' => $filename,
                'path' => $path
            ]);
            $image->save();
            $id = $image->id;
        }

        return $id;
    }

    public function saveArticle(Request $request){
        if($user = Auth::guard('consultant')->user()) {
            $input = $request->all();

            $v = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'image_url' => 'required',
                'content' => 'required'
            ]);
            $v->after(function ($v) use ($request, &$input) {
                $image_id = $this->createImage($request->get('image_url'));
                if($image_id){
                    $input['image_id'] = $image_id;
                } else {
                    $v->errors()->add('image', 'Image not found');
                }

            });
            if ($v->fails()) {
                return Redirect::back()->withErrors($v->errors())->withInput();
            }

            $input['user_id'] = $user->id;
            $input['url'] = $this->generateUrl($input['title']);
            $input['hide_name'] = $request->has('hide_name') ? 1 : 0;
            $input['hide_email'] = $request->has('hide_email') ? 1 : 0;
            $input['disable_comments'] = $request->has('disable_comments') ? 1 : 0;
            $input['status'] = 1;
            $input['reviewed'] = 1;

            $article = new Article();
            $article->fill($input);
            $article->save();

            Flash::success('Article has been saved');
            return Redirect::action('ConsultantController@editArticle', ['id' => $article->id]);
        } else {
            return Redirect::action('FrontendController@index');
        }
    }

    function generateUrl($title){
        $slug = strtolower($title);
        $slug = preg_replace('/\W+/','-',$slug);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
        $slug = ltrim($slug, '-');
        return $slug;
    }

    function interactiveAnswer(){
        $consultant = Auth::guard('consultant')->user();
        $questions = Questions::where(['status' => 1, 'consultant_id' => $consultant->id])->orderBy('asked_at', 'ASC')->limit(10)->get();
        $current = null;
        if(count($questions) > 0){
            $current = $questions[0];
        }
        $pending = Questions::where(['status' => 1, 'consultant_id' => $consultant->id])->count();
        $answers = Questions::where(['status' => 2, 'consultant_id' => $consultant->id])
            ->where('answered_at', '>', date('Y-m-d', time()).' 00:00:00')
            ->where('answered_at', '<', date('Y-m-d', time()).' 24:00:00')
            ->get();
        $total_time = 0;
        foreach($answers as $answer){
            $total_time += $answer->timer;
        }
        $average_time = ($count = count($answers)) > 0 ? floor(($total_time / $count)/60) : 0;
        return view('consultant/questions/interactive')->with([
            'consultant' => $consultant,
            'questions' => $questions,
            'answers' => $answers,
            'average_time' => $average_time,
            'pending' => $pending,
            'current' => $current
        ]);
    }
}
