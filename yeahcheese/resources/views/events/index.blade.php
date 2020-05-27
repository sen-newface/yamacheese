@extends('events.layout')

@section('content')
    <h1>イベント一覧</h1>
    <table class='table table-striped table-hover'>
        <tr>
            <th>イベントID</th><th>イベント名</th><th>公開開始日</th><th>公開終了日</th><th>認証キー</th><th>写真枚数</th><th></th>
        </tr>
        @foreach ($events as $event)
            <tr>
                <td>
                    {{ $event->id }}
                </td>
                <td>
                    {{ $event->name }}
                </td>
                <td>
                    {{ $event->start_at }}
                </td>
                <td>
                    {{ $event->end_at }}
                </td>
                <td>
                    {{ $event->authorization_key }}
                </td>
                <td>
                    {{ $event->photos()->count() }}
                </td>
                <td>
                    <div>
                        <a href="{{ route('events.edit', $event) }}" class='btn btn-outline-primary'>編集する</a>
                    </div>
                </td>
            </tr>
        @endforeach
    <div>
        <a href="{{ route('events.create') }}" class='btn btn-outline-primary'>イベント新規作成</a>
    </div>
@endsection
