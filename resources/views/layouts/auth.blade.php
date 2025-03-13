<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .auth-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 300px;
        }

        .input-group {
            width: 100%;
            max-width: 250px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .input-group label {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }

        .success-message {
            color: green;
            font-size: 14px;
        }

        button {
            width: 100%;
            max-width: 250px;
            background-color: #f66;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e55;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        @yield('content')
    </div>
</body>

</html>