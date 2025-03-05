<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; }
        form { display: inline-block; text-align: left; }
        input { display: block; margin-bottom: 10px; width: 250px; padding: 5px; }
        button { background-color: #f66; color: white; padding: 10px 20px; border: none; }
    </style>
</head>
<body>
    <h1>新規会員登録</h1>
    <form method="POST" action="{{ route('user.register') }}">
        @csrf
        <input type="text" name="name" placeholder="ユーザー名" required>
        <input type="text" name="name_kana" placeholder="カナ" required>
        <input type="email" name="email" placeholder="メールアドレス" required>
        <input type="password" name="password" placeholder="パスワード" required>
        <input type="password" name="password_confirmation" placeholder="パスワード確認" required>
        <button type="submit">登録</button>
    </form>
    <p><a href="{{ route('login') }}">ログインはこちら</a></p>
</body>
</html>
