<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function successPayment($firstName, $lastName, $paymentId, $email){
        Mail::to($email)
            ->send(new PaymentMail($firstName, $lastName, $paymentId));
    }
}
