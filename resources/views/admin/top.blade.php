@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card border-2 m-5 p-4">
        <h1>ユーザーネーム： {{ Auth::user()->name }}</h1>
        <h1>メールアドレス：{{ Auth::user()->email }}</h1>
        </div>
    </div>
@endsection    