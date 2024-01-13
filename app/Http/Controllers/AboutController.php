<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class AboutController extends Controller
{
    public function index(){
    $information = Info::first();
        return view('dashboard.about', [
            "title" => 'Information',
            'info' => $information
        ]);
    }
    public function update(Request $request){
        $validatedData = $request->validate([
            'infoName' => 'required|string|min:10|max: 255',
            'info' => 'required|string|min: 70',
        ]);
        Info::where('id', $request->id)->update($validatedData);
        return redirect('/dashboard/manage-about');
    }
}
