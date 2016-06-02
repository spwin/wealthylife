<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class FrontendController extends Controller
{
    public function index(){
        $modal = Input::has('modal') ? Input::get('modal') : '';
        $videos = ['training', 'video'];
        return view('frontend/pages/index')->with([
            'video' => $videos[array_rand($videos)],
            'modal' => $modal
        ]);
    }

    public function blog(){
        return view('frontend/pages/blog')->with([

        ]);
    }
}
