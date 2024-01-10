<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Prices;
use Illuminate\Http\Request;

class PricesDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Events $events)
    {
        Prices::create([
            "events_id" => $events->id
        ]);
        return redirect("/dashboard/manage-event/tag=$events->slug");
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
    public function show(Prices $prices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prices $prices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $events)
    {
        // dd($request);
        $validatedData = $request->validate([
            'priceTag'=>['required','string'],
            'price'=>['required'],
            'priceDesc' => ['required'],
            'position_id' => 'required'
        ]);
        $validatedData['price'] = str_replace('.', '', $validatedData['price']);
        Prices::where('id', $request->id)->update($validatedData);
        return redirect ("/dashboard/manage-event/tag=$events->slug")->with("success","Prices Has Updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Prices::where('id', $request->id)->delete();
        return redirect("/dashboard/manage-event/tag=$request->slug");
    }
}
