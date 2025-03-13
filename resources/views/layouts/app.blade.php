<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '教育システム')</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { width: 80%; margin: 0 auto; }

        /* 共通ヘッダー */
        .header {
            background-color: #E57373;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .logout-btn {
            padding: 10px 15px;
            background-color: #D84315;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }

        .logout-btn:hover {
            background-color: #B71C1C;
        }
    </style>
</head>
<body>

    <!-- 共通ヘッダー -->
    <div class="header">
        <div class="nav-buttons">
            <a href="{{ route('user.show.schedule') }}">時間割</a>
            <a href="{{ route('user.show.progress') }}">授業進捗</a>
            <a href="{{ route('user.show.profile') }}">プロフィール設定</a>
        </div>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">ログアウト</button>
        </form>
    </div>

    @yield('content')

</body>
</html>
