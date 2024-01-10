<?php

namespace App\Http\Controllers;

use App\Models\Position;
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
            "price" => Prices::where('events_id', $events['id'])->get(),
            "jobs" => Position::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.manage-event.edit-event', 
        [
            "title" => "Adding Event",
            "events" => 0
        ]
    );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'slug' => 'required',
            'excerpt'=>['required','string'],
            'eventName'=>['required','string', 'min:10'],
            'eventDesc'=>['required','string'],
            'eventDate' => 'required',
            'status' => 'required'
        ];
        $validatedData = $request->validate($rules);
        if ($request->file('img')) {
            $image = $request->file('img');
            $imageName = $image->hashName();
            $imagePath = $image->store('events-images');
            $validatedData['img'] = $imageName;
        } else {
            $validatedData['img'] = null;
        }
    
        Events::create($validatedData);
        return redirect("/dashboard/manage-event/tag=$request->slug")->with("success", "Events Has Added!");
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
            'status' => 'required',
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
    public function destroy(Request $request)
    {
        Events::destroy("id", $request->id);
        return redirect('/dashboard/manage-event');
    }
    
}
