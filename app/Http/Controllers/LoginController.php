<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    public function index()
    {
        return view('login',
        [
            'id'=> '1',
            "title" => 'Login'
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'Please check your account and password.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/'); 
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $find = User::where('google_id', $user->id)->first();
            $condition = User::where('email', $user->email)->first();
            if ($find) {
                Auth::login($find);
 
                return redirect()->intended('/');
            }else {
                if ($condition) {
                    return redirect('/login')->with('googleError', 'Silahkan login dengan akun Anda!');
                }
                else {
                    $newUser = User::create([
                        'google_id' => $user->id,
                        'email'=> $user->email,
                        'firstName' => $user->user['given_name'],
                        'lastName' => $user->user['family_name'],
                        'password' =>  Hash::make($user->id.$user->email),
                    ]);
                    Auth::login($newUser);
                    return redirect()->intended('/');
                }
            }
        } catch (\Throwable $th) {
            return redirect('/login')->with('internalError', 'Silahkan kembali login');
        }
        
    }
}
