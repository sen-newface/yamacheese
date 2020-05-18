@extends('events.layout')

@section('content')
    <h1>イベント一覧</h1>
    @foreach ($events as $event)
        <p>
            {{ $event->id }},
            {{ $event->name }},
            {{ $event->start_at }},
            {{ $event->end_at }},
            {{ $event->authorization_key }},
            {{ $event->user_id }}
        </p>
    @endforeach
    <div>
        <a href="{{ route('events.create') }}" class='btn btn-outline-primary'>イベント新規作成</a>
    </div>
@endsection
