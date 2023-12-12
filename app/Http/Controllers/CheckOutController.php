<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index(Request $request)
    {
        Session::put('data', $request->data);
        $data = Session::get('data');

        if ($data != []) {
            return view("check-out",[
                'title' => "Check Out",
                'id' => 1
            ]);
        }
        return redirect('/')->with('error','Please Select At Least 1 Item');
    }
    public function recheckout()
    {
            return view("check-out",[
                'title' => "Check Out",
                'id' => 1]);
    }
    public function delete(Request $request)
    {

        $index = $request->input('delete');

        $data = session('data');

        array_splice($data, $index, 1);

        session(['data' => $data]);

        return view("check-out",[
            'title' => "Check Out",
            'id' => 1
        ]);
    }
}
