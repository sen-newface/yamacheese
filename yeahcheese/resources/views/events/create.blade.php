@extends('events.layout')

@section('content')
    <h1>イベント新規作成</h1>
    <form action="/events" method="POST">
        {{ csrf_field() }}
        <div>
            <label>イベント名</label><br>
            <input type="text" name="name" />
        </div>
        <div>
            <label>公開開始日</label><br>
            <input type="date" name="start_at" />
        </div>
        <div>
            <label>公開終了日</label><br>
            <input type="date" name="end_at" />
        </div>
        <div>
            <input type="submit" value="作成する" />
        </div>
    </form>
@endsection
