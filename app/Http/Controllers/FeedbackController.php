<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(){
        return view('dashboard.feedBack.feedBack', [
            "feedBack" => Info::where('infoName', 'feedBack')->get(),
            "title" => "Feedback Panel"
        ]);
    }
    public function show(Info $item){
        return view('dashboard.feedBack.details', [
            "feedBack" => $item,
            "title" => "Feedback Detail"
        ]);
    }
}
