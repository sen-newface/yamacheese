<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>event list</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
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
    </body>
</html>
