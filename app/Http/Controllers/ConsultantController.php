<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Questions;
use App\User;
use App\UserData;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ConsultantController extends Controller
{
    public function index(){
        return view('consultant/dashboard/dashboard');
    }

    public function login(){
        return view('consultant/login');
    }

    public function listUsers(){
        $users = User::with('userData')->where(['type' => 'user'])->orderBy('created_at', 'DESC')->get();
        return view('consultant/users/list')->with([
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
        $user_data = UserData::where(['user_id' => $user->id])->first();
        $econf = $this->getEmailConfirmation($user);
        return view('consultant/users/profile')->with([
            'user' => $user,
            'user_data' => $user_data,
            'econf' => $econf
        ]);
    }

    public function listPending(){
        $questions = Questions::where(['status' => 1])->get();
        return view('consultant/questions/list')->with([
            'questions' => $questions,
            'status' => 'Pending',
            'stat' => 1
        ]);
    }

    public function listAnswered(){
        $questions = Questions::where(['status' => 2])->get();
        return view('consultant/questions/list')->with([
            'questions' => $questions,
            'status' => 'Answered',
            'stat' => 2
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

    public function answerSend($id){
        $answer = Answers::findOrFail($id);
        $question = $answer->question()->first();
        $question->status = 2;
        $question->save();
        return Redirect::action('ConsultantController@listPending');
    }
}
