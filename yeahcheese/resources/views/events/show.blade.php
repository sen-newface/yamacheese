<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>even.show</title>
        <style>body {padding: 80px;}</style>
        @include('style-sheet')
    </head>
    <h1>写真閲覧</h1>
    <table class='table table-striped table-hover'>
        <tr>
            <th>イベント名</th><th>写真枚数</th>
        </tr>
        <tr>
            <td>
                {{ $event->name }}
            </td>
            <td>
                {{ $event->photos()->count() }}
            </td>
        </tr>
    </table>
    @foreach ($event->photos as $photo)
        <div style="margin: 10px;border: 1px solid;width:50%;">
            <img src="{{ \Storage::url($photo->path) }}" style="width:250px"><br>
            ID：{{ $photo->id }}<br>
            Updated：{{ $photo->updated_at }}<br>
        </div>
    @endforeach
</html>
