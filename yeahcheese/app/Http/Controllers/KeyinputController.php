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
        elseif (date("Y-m-d") < $event->start_at) {
            return redirect('/keyinput')->with('error', '公開期間前です');
        }
        elseif ($event->end_at < date("Y-m-d")) {
            return redirect('/keyinput')->with('error', '公開期間が過ぎています');
        }
        return view('events.show', ['event' => $event]);
    }
}
