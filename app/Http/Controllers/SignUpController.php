<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function index()
    {
        return view('signup',
        [
            'id'=> '1',
            "title" => 'SignUp'
        ]);
    }
    
    public function store(Request $request){
        $validatedData = $request->validate([
            'firstName'=>['required','string','regex:/[a-z]/','regex:/[A-Z]/', 'min:3', 'max:255'],
            'lastName'=>['required','string','regex:/[a-z]/','regex:/[A-Z]/', 'min:1', 'max:255'],
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                // 'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'birthDate' => "date|required|before: 20 October 2015",
            'email'     => 'required|email:dns|unique:users'
        ]);
        $validatedData['password'] = Hash::make($validatedData["password"]);
        User::create($validatedData);
        // $user = User::where("email", $validatedData["email"])->first();
        return redirect ('/login')->with("success","Registration successfull! Please Login!");
    }    
}
