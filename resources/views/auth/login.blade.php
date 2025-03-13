@extends('layouts.auth')

@section('title', 'ログイン')

@section('content')
    <h1>ログイン</h1>

    <!-- エラーメッセージ -->
    @if ($errors->any())
        <div class="error-messages">
            @foreach ($errors->all() as $error)
                <p class="error-message">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('user.login') }}" novalidate>
        @csrf

        <div class="input-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="input-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">ログイン</button>
    </form>

    <p><a href="{{ route('user.show.register') }}">新規会員登録はこちら</a></p>
@endsection