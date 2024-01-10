<?php

namespace App\Http\Controllers;

use App\Mail\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailCertif extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Mail::to('samuelzakaria28@gmail.com')
            ->send(new Sertifikat);

        return 'success';
    }
}
