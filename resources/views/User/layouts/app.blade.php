<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <header class="p-3" style="display: flex; justify-content:space-between; align-items:center; padding:10px 20px; background-color:#F26B4A">
            <div class="menu-buttons">
                <a href="{{ route('user.show.curriculum') }}" class="btn btn-success">時間割</a>
                <a href="{{ route('user.show.progress') }}" class="btn btn-success ms-2">授業進捗</a>
                <a href="{{ route('user.show.profile') }}" class="btn btn-success ms-2">プロフィール設定</a>
            </div>
            <nav>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="btn" style="background-color: #F26B4A; color:black; border:none;">ログアウト</button>
                </form>
            </nav>
        </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
