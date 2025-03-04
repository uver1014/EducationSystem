<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '教育システム')</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 20px;
        }

        /* 共通ヘッダー */
        .header {
            background-color: #E57373;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 5px;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .nav-buttons a {
            padding: 10px 15px;
            background-color: #26A69A;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background 0.3s;
        }

        .nav-buttons a:hover {
            background-color: #00796B;
        }

        .logout-btn {
            background-color: #D84315;
        }

        .logout-btn:hover {
            background-color: #BF360C;
        }

        /* バナーエリア */
        .banner-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
        }

        .banner-slider {
            display: flex;
            overflow: hidden;
            border-radius: 10px;
        }

        .banner-image {
            width: 100%;
            max-width: 800px;
            border-radius: 10px;
        }

        .banner-indicators {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .indicator {
            width: 10px;
            height: 10px;
            background-color: #6d4c41;
            border-radius: 50%;
            margin: 0 5px;
        }

        /* お知らせセクション */
        .notice-section {
            margin-top: 30px;
            text-align: left;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .notice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .notice-table td {
            padding: 10px;
            font-size: 14px;
        }

        .date {
            width: 20%;
            color: gray;
        }

        .title {
            width: 80%;
        }
    </style>
</head>
<body>

    <!-- 共通ヘッダー -->
    <div class="header">
        <div class="nav-buttons">
            <a href="{{ route('user.schedule') }}">時間割</a>
            <a href="{{ route('user.progress') }}">授業進捗</a>
            <a href="{{ route('user.profile') }}">プロフィール設定</a>
        </div>
        <a href="{{ route('logout') }}" class="logout-btn"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           ログアウト
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- 各ページのコンテンツ -->
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
