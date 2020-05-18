<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>layout</title>
        <style>body {padding: 80px;}</style>
        @include('style-sheet')
    </head>
    <body>
        @include('events.header')
        <div class='container'>
            @yield('content')
        </div>
    </body>
</html>
