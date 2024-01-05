<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Events;
use App\Models\Jobs;
use App\Models\Prices;
use Illuminate\Http\Request;

class BucketController extends Controller
{
    public function create(Request $request, Events $event){
        $data = $request->except("_token", "job_id");
        Bucket::create($data);
        $jobId = $request->job_id;
        return view('home',
    [
        'id' => $event->id,
        "title" => "Home",
        
        "jobs" => Jobs::all(),
        "job" => Jobs::where('id', $jobId)->first(),
        "events" => Prices::where('events_id', $event->id)->with('events')->first(),
        "price" => Prices::where('events_id', $event->id)->where('job_id', $jobId)->with('events')->get()
    ]);
    }
    // public function create(Request $request){
    //     $data = $request->except("_token");
    //     Bucket::create($data);
    //     return redirect("/");
    // }
    public function delete(Request $request){
        Bucket::find($request->id)->delete();
        return redirect('/');
    }
}
