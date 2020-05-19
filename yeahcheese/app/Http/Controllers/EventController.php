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

        $event->name = $request->name;
        $event->start_at = $request->start_at;
        $event->end_at = $request->end_at;
        $event->authorization_key = EventController::makeAuthorizationKey();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

    public function makeAuthorizationKey($length = 8)
    {
        $max = pow(10, $length) - 1;
        $rand = random_int(0, $max);
        $code = sprintf('%0'. $length. 'd', $rand);

        $events = Event::all()->pluck('authorization_key');
        foreach ($events as $id => $authorizationkey) {
            if ($code === $authorizationkey) {
                $max = pow(10, $length) - 1;
                $rand = random_int(0, $max);
                $code = sprintf('%0'. $length. 'd', $rand);
            }
            $code = $code;
        }

        return $code;
    }
}
