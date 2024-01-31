<?php 

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::find(1);
        return view('dashboard.emails.index', ["title" => "Manage Email"], compact('emails'));
    }

    public function edit($id)
    {
        $email = Email::findOrFail($id);
        return view('admin.emails.edit', compact('email'));
    }

    public function update(Request $request, $id)
    {
        $email = Email::findOrFail($id);
        $email->update($request->only('email_subject', 'email_body'));

        return redirect()->route('admin.emails.index');
    }
}
