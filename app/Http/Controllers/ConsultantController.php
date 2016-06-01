<?php

namespace App\Http\Controllers;

use App\Questions;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ConsultantController extends Controller
{
    public function index(){
        return view('consultant/dashboard/dashboard');
    }

    public function login(){
        return view('consultant/login');
    }
}
