<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlastEmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.emails.blast.index', [
            "title" => "Blasting Email"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedItem = $request->validate([
            
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('dashboard.emails.editor.editMail', [
            "title" => "Edit Email"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
