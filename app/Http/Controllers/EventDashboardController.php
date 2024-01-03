<?php

namespace App\Http\Controllers;

use App\Models\Prices;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\Events;

class EventDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Events $events)
    {
        return view('dashboard.manage-event.edit-event', [
            "title" => "Manage Event",
            "events" => Events::where('id', $events->id)->first(),
            "price" => Prices::where('events_id', $events['id'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Events $events)
    {
        $rules = [
            'eventName'=>['required','string', 'min:10'],
            'excerpt'=>['required','string'],
            'eventDesc'=>['required','string'],
            // 'img' => 'image|file|max: 5120',
            'eventDate' => 'required'
        ];

        if($request->slug != $events->slug){
            $rules['slug'] = 'required';
        };

        $validatedData = $request->validate($rules);
        if ($request->file('img')) {
            $image = $request->file('img');
            $imageName = $image->hashName();
            $imagePath = $image->store('events-images');
            $validatedData['img'] = $imageName;
        } else {
            // Tambahkan kondisi jika tidak ada gambar yang diunggah
            // Misalnya, Anda ingin mempertahankan gambar yang sudah ada
            // Anda dapat menyesuaikan bagian ini sesuai kebutuhan Anda
            $validatedData['img'] = $events->img;
        }
    
        Events::where('id', $events->id)->update($validatedData);
        return redirect("/dashboard/manage-event/tag=$request->slug")->with("success", "Events Has Updated!");
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Events::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
