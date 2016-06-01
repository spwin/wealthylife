<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FrontendController extends Controller
{
    public function index(){
        $videos = ['training', 'video'];
        return view('frontend/pages/index')->with([
            'video' => $videos[array_rand($videos)]
        ]);
    }
}
