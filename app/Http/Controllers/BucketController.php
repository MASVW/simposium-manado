<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Events;
use App\Models\Position;
use App\Models\Prices;
use Illuminate\Http\Request;

class BucketController extends Controller
{
    public function create(Request $request, Events $event){
        $data = $request->except("_token", "job_id");
        Bucket::create($data);
        $jobId = $request->job_id;
        return redirect("/tag={$event->slug}")->with([
        'id' => $event->id,
        "title" => "Home",
        
        "jobs" => Position::all(),
        "job" => Position::where('id', $jobId)->first(),
        "events" => Prices::where('events_id', $event->id)->with('events')->first(),
        "price" => Prices::where('events_id', $event->id)->where('positions_id', $jobId)->with('events')->get()
    ]);
    }

    public function delete(Request $request){
        Bucket::find($request->id)->delete();
        return redirect('/');
    }
}
