<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @vite(['resources/css/app.css'])
        <title>バナー設定</title>
    </head>
    
    <body>
    @extends('layouts.app')
    @section('content')
        <div class="container">
            <h1>バナー設定</h1>
        </div>
    @endsection
    </body>
</html>
