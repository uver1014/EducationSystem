<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @vite(['resources/css/app.css'])
        <title>お知らせ新規登録</title>
    </head>
    
    <body>
    @extends('layouts.app')
    @section('content')
        <div class="container">
            <h1>お知らせ一覧</h1>
        </div>
    @endsection
    </body>
</html>
