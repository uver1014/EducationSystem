@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card">
        <h1>ユーザーネーム： {{ Auth::user()->name }}</h1>
        <h1>メールアドレス：{{ Auth::user()->email }}</h1>
        </div>
    </div>
@endsection    