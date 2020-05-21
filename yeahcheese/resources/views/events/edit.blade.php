@extends('events.layout')

@section('content')
    <h1>イベント編集</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('events.update', $event) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <input type='hidden' name='id' value='{{ $event->id }}' />
        <input type='hidden' name='authorization_key' value='{{ $event->authorization_key }}' />
        <input type='hidden' name='user_id' value='{{ $event->user_id }}' />
        <div>
            <label>イベント名</label><br>
            <input type="text" name="name" value="{{old('name')}}" />
        </div>
        <div>
            <label>公開開始日</label><br>
            <input type="date" name="start_at" value="{{old('start_at')}}" />
        </div>
        <div>
            <label>公開終了日</label><br>
            <input type="date" name="end_at" value="{{old('end_at')}}" />
        </div>
        <div>
            <input type="submit" value="作成する" />
        </div>
    </form>
@endsection
