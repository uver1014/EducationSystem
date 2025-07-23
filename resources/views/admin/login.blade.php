<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @vite(['resources/css/app.css'])
        <title>管理画面ログイン</title>
    </head>
    
    <body>
    @extends('layouts.app')
    @section('content')
        <div class="container">
            <h1>管理画面ログイン</h1>
        </div>
    @endsection
    </body>
</html>
