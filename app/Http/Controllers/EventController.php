<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $events = Event::all();
    //     return view('pages.update.calendar', compact('events'));
    // }

    public function index()
    {
        $events = Event::all();
        $eventsArray = [];

        foreach ($events as $event) {
            $eventsArray[] = [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'description' => $event->description,
            ];
        }

        $eventsJson = json_encode($eventsArray);

        $userRole = auth()->user()->role;
        return view('pages.update.calendar', compact('eventsJson', 'userRole'));
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
        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->save();

        return redirect()->back()->with('success', "L'évènement a bien été ajouté");
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return back()->with('success', "Cet évènemet vient d'être supprimé");
    }
}
