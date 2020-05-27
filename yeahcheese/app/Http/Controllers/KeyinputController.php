<?php

namespace App\Http\Controllers;

use App\Event;
use App\Photo;
use Illuminate\Http\Request;

class KeyinputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('keyinput');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::where('authorization_key', $request->input('authorization_key'))->first();
        if (is_null($event)) {
            return redirect('/keyinput')->with('error', '認証キーが間違っています');
        }
        $photos = Photo::where('event_id', $event->id)->get();
        return view('events.show', ['event' => $event, 'photos' => $photos]);
    }
}
