<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; }
        form { display: inline-block; text-align: left; }
        input { display: block; margin-bottom: 10px; width: 250px; padding: 5px; }
        button { background-color: #f66; color: white; padding: 10px 20px; border: none; }
    </style>
</head>
<body>
    <h1>ログイン</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="メールアドレス" required>
        <input type="password" name="password" placeholder="パスワード" required>
        <button type="submit">ログイン</button>
    </form>
    <p><a href="{{ route('register') }}">新規会員登録はこちら</a></p>
</body>
</html>
