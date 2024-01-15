<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ChangePass extends Controller

{
    use ResetsPasswords;
    public function index() {
        return view('forgot-password', 
            [
                "id" => null,
                "title" => "Home",
            ]
        );
    }
    public function forgetPassword(Request $request){
        $request->validate(['email' => 'required|email']);
     
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
        }
    public function showResetForm(){
        return view('changePass',
        [
            "id" => null,
            "title" => "Change Password",
        ]
    );
    }
    public function reset(Request $request){
        return "berhasil"; // Customize this to your needs
    }
}
