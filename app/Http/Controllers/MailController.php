<?php

namespace App\Http\Controllers;

use App\Mail\ChangePasswordMail;
use App\Mail\PaymentMail;
use App\Mail\RegisteredMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function register($firstName, $lastName, $email){
        Mail::to($email)
            ->queue(new RegisteredMail($firstName, $lastName));
    }
    public function successPayment($firstName, $lastName, $paymentId, $email){
        Mail::to($email)
            ->queue(new PaymentMail($firstName, $lastName, $paymentId));
    }
    public function changePassword($firstName, $lastName, $email){
        Mail::to($email)
            ->queue(new ChangePasswordMail($firstName, $lastName));
    }
}
