@extends('events.layout')

@section('content')
    <h1>イベント編集</h1>
        <body>        
            <div id="app">
                <eventedit-component
                    name="{{$event->name}}"
                    start_at="{{$event->start_at}}"
                    end_at="{{$event->end_at}}"
                    id="{{$event->id}}"
                ></eventedit-component>
            </div>
            <script src="{{ mix('js/app.js') }}"></script>
        </body>
@endsection
