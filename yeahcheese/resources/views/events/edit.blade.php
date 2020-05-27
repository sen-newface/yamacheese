@extends('events.layout')

@section('content')
    <h1>イベント編集</h1>
        <body>        
            <div id="app">
                <eventedit-component
                    :event="{{json_encode($event)}}"
                ></eventedit-component>
            </div>
            <script src="{{ mix('js/app.js') }}"></script>
        </body>
@endsection
