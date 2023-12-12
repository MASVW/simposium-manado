<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Prices;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('dashboard.dashboard', [
            'title'=> 'Dashboard',
            "event" => Events::all(),
        ]);

    }
    //uda
    public function eventView(){
        return view('dashboard.view', [
            "title" => "Event",
            // "event" => Events::all(),
            "data" => Events::all(),

        ]); 
        
    }
    public function eventManage(){
        return view('dashboard.manage-event', [
            "title" => "Manage Event",
            "event" => Events::all(),
        ]);
    }

    // delete
    public function delPrice(Events $event){ 
        return view('dashboard.edit-event', [
            "title" => "Manage Event",
            "event" => Prices::where('events_id', $event->id)->with('events')->get()
        ]);
    }
    public function viewPayment(){
        return view('dashboard.manage-payment', [
            "title" => "Manage Payment",
            "event" => Events::all(),
        ]);
    } 
}
