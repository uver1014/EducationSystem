@extends('layouts.auth')

@section('title', '新規会員登録')

@section('content')
    <h1>新規会員登録</h1>

    @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('user.register') }}" novalidate>
        @csrf
        <div class="input-group">
            <label for="name">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')    <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="input-group">
            <label for="name_kana">カナ</label>
            <input type="text" id="name_kana" name="name_kana" value="{{ old('name_kana') }}" required>
            @error('name_kana')      <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="input-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')   <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="input-group">
            <label for="password">パスワード（8文字以上）</label>
            <input type="password" id="password" name="password" required>
            @error('password')    <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="input-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">登録</button>
    </form>

    <p><a href="{{ route('user.show.login') }}">ログインはこちら</a></p>
@endsection