<?php

namespace App\Http\Controllers;
use App\Models\Bucket;
use App\Models\Events;
use App\Models\Info;
use App\Models\Position;
use App\Models\Prices;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\VarDumper;

class Navigation extends Controller
{
    public function home(){
        $jobId = 1;
        $event = Events::where('status', 1)->with('prices')->first();
        if ($event == null) {
            return view('home',
            [
                "id" => null,
                "title" => "Home",
            ]);
        }
        else {
            return view('home',
            [
                "id" => $event->id,
                "title" => "Home",
        
                "jobs" => Position::all(),
                "job" => Position::where('id', $jobId)->first(),
                "events" => $event,
                "price" => Prices::where('events_id', $event['id'])->where('positions_id', $jobId)->with('events')->get()
                
            ]);
        }
    }
    public function homePrice(Request $request, Events $event){
        $jobId = $request->job_id;
        return view('home',
    [
        'id' => $event->id,
        "title" => "Home",
        
        "jobs" => Position::all(),
        "job" => Position::where('id', $jobId)->first(),
        "events" => Events::where('id', $event->id)->with('prices')->first(),
        "price" => Prices::where('events_id', $event->id)->where('positions_id', $jobId)->with('events')->get()
    ]);
    }
    public function withId(Events $event)
    {
        $jobId = 1;
        return view('home',
    [
        'id'=> $event->id,
        "title" => 'Home',

        "jobs" => Position::all(),
        "job" => Position::where('id', $jobId)->first(),
        "events" => Events::where('id', $event->id)->with('prices')->first(),
        "price" => Prices::where('events_id', $event->id)->where('positions_id', $jobId)->with('events')->get()
    ]);
    }

    public function about()
    {
        return view('about', 
        [
            'id'=> '1',
            "title" => 'AboutUs',
            "info" => Info::first(),
        ]);
    }
    public function profile()
    {
        return view('profile', 
        [
            'id'=> '1',
            "title" => 'Profile',
        ]);
    }
    public function history()
    {
        $items = Bucket::where('users_id', auth()->user()->id)
        ->with('prices.positions', 'events', 'payments', "datas")
        ->whereHas('payments', function ($query) {
            $query->where('status', '=', 'Paid');
        })
        ->get();
    $unSuccess = Bucket::where('users_id', auth()->user()->id)
        ->with('prices.positions', 'events', 'payments')
        ->whereHas('payments', function ($query) {
            $query->where('status', '=', 'Unpaid');
        })
        ->get();
        return view('history', 
        [
            'id'=> '1',
            "title" => 'Profile',
            "item" => $items,
            "unsuccess" => $unSuccess
        ]);
    }

    public function editProfile(){
        {
            return view('profileEdit',[
                'id'=> '1',
                "title" => 'editProfile',
                "menu" => '1'
            ]);
        }
    }
    public function editing(Request $request){
        {
            // dd($request);
            $validatedData = $request->validate([
                'firstName'=>['string','regex:/[a-z]/','regex:/[A-Z]/', 'min:3', 'max:255'],
                'lastName'=>['string','regex:/[a-z]/','regex:/[A-Z]/', 'min:1', 'max:255'],
                'birthDate' => "date|required|before: 20 October 2015",
                'email' => 'required|email:dns|unique:users,email,' . Auth::id()
            ]);
            
            $data = $request->except('_token');
            $oldData = User::where('email', auth()->user()->email)->first();
            if ($oldData) {
                $oldData->update($data);
                Auth::setUser($oldData->fresh());
            };
            return view('profile', 
            [
                'id'=> '1',
                "title" => 'Profile',
            ]);
        }
    }
    public function editingPass(){
        {
            return view('profileEdit',[
                'id'=> '1',
                "title" => 'editProfile',
                "menu" => '2'
            ]);
        }
    }
    public function editPass(Request $request){
        {
            // dd($request);
            $validatedData = $request->validate([
                'oldPass' => [
                    'required',
                    'string',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    // 'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                'newPass'   => [
                    'required',
                    'string',
                    'min:8',             // must be at least 10 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    // 'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                'confPass'  => [
                    'required',
                    'same:newPass'
                ],
            ]);
            $newPass = Hash::make($validatedData["newPass"]);
            $oldPass = $validatedData["oldPass"];
            $pass = auth()->user()->password;
            if (Hash::check($oldPass, $pass)) {
                $email = auth()->user()->email;
                $user = User::where('email', $email)->first();
                // Update password user dengan password baru
                $user->update(['password' => $newPass]);

                return redirect('/profile')->with('success', 'Password Anda berhasil diubah!');
            }
            else{
                return back()->withErrors([
                    'oldPass' => 'Please input your Old Password',
                ]);
            };
        }
    }

    public function feedbackForm(Request $request){
        $item = $request->except('_token'); 
        dd($item);
        
        //emailing feedback form

        //saving to database
    }
    
    
}
