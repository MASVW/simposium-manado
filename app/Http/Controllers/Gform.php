<?php

namespace App\Http\Controllers;

use App\Models\Datas;
use Illuminate\Http\Request;

class Gform extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $dataFromGForm = $request->all();
        $email = $dataFromGForm['Email']; 
        $datas = Datas::where('email', $email)->first();
        if ($datas) {
            $datas->attendance = true;
            $datas->save();
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
