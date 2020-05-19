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

    public function makeAuthorizationKey()
    {
        // 8桁の数字を作る
        $length = 8;
        $max = pow(10, $length) - 1;
        $rand = random_int(0, $max);
        return sprintf('%0'. $length. 'd', $rand);
    }

    public function existAuthorizationKey($code)
    {
        $events = Event::all()->pluck('authorization_key');  // 今あるkeyを全部とってくる
        foreach ($events as $authorizationkey) {  // 今あるkeyを1つ1つ取り出す
            if ($code === $authorizationkey) {  // 比較して、同じkeyがあったら、8桁の数字を作り直す
                return true;
            }
        }
        return false;
    }

    public function remakeAuthorizationKey()
    {
        $a = $this->makeAuthorizationKey();
        if ($this->existAuthorizationKey($a)) {
            $this->remakeAuthorizationKey();
        }
        return $a;
    }
}
