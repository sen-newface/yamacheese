<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Auth::user()->event()->get();
        return view('events.index', [ 'events' => $events ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'filled',
            'start_at' => 'filled|required_with:end_at|date_format:Y-m-d',
            'end_at' => 'filled|required_with:start_at|after_or_equal:start_at|date_format:Y-m-d',
        ]);

        $event = new Event();

        $event->fill($request->all());
        $event->authorization_key = $this->makeAuthorizationKey();
        $event->user_id = Auth::user()->id;
        $event->save();
        return redirect('/events');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function eightDigitNumber()
    {
        $length = 8;
        $max = pow(10, $length) - 1;
        $rand = random_int(0, $max);
        return sprintf('%0'. $length. 'd', $rand);
    }

    public function existAuthorizationKey($code)
    {
        $authorizationkeys = Event::all()->pluck('authorization_key');
        if ($authorizationkeys->contains($code)) {
            return true;
        }
        return false;
    }

    public function makeAuthorizationKey()
    {
        $code = $this->eightDigitNumber();
        if ($this->existAuthorizationKey($code)) {
            $this->makeAuthorizationKey();
        }
        return $code;
    }
}
