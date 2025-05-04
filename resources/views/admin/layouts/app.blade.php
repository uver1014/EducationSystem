<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>管理者ページ</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="{{ asset('js/admin/banner_management.js') }}"></script>
</head>
<body>
    <div id="app">
        <header class="d-flex justify-content-between align-items-center p-4 bg-info">
            <div class="menu-buttons">
                <a href="{{ route('admin.show.curriculum.list')}}" class="btn btn-secondary">授業管理</a>
                <a href="{{ route('admin.show.article.list')}}" class="btn btn-secondary ms-2">お知らせ管理</a>
                <a href="{{ route('admin.show.banner.edit')}}" class="btn btn-secondary ms-2">バナー管理</a>
            </div>
            <nav>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-info text-white border-0">ログアウト</button>
                </form>
            </nav>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>