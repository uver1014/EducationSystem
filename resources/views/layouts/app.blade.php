<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="header">
            <div class="header-controls">
                <a href="{{ route('admin.show.curriculum.list') }}" class="btn-curriculum">授業管理</a>
                <a href="{{ route('admin.show.article.list') }}"  class="btn-notice">お知らせ管理</a>
                <a href="{{ route('admin.show.banner.edit') }}"  class="btn-banner">バナー管理</a>
                <a href="#" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
