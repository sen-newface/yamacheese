<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>keyinput</title>
        <style>body {padding: 80px;}</style>
    </head>
    <h1>認証キー入力</h1>
    @if (session('error'))
        <p class="text-danger mt-3">
            {{ session('error') }}
        </p>
    @endif
    <form action="{{ route('keyinput.store') }}" method="POST">
        {{ csrf_field() }}
        <div>
            <label>認証キー</label><br>
            <input type="text" name="authorization_key" />
        </div>
        <div>
            <input type="submit" value="送信（写真を見る）" />
        </div>
    </form>
</html>
