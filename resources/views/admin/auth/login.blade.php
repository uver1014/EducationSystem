{{-- <!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>管理者ログインページ</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <header class="d-flex justify-content-between align-items-center p-3">    
            <nav class="mt-5 ms-auto">    
                <a href="{{ route('admin.show.register') }}" class="me-5 text-dark text-decoration-none fs-5">新規会員登録はこちら</a>
            </nav>
        </header>    
    <div class="row justify-content-center">
        <div class="col-md-8">      
                <h1 class="text-center">管理画面ログイン</h1>
                <div class="mt-5">
                    <form method="POST" action="{{ route('admin.show.login') }}"novalidate>
                        @csrf
                        @if (session('errors'))
                            <div class="alert alert-danger">
                                <ul>
                        @foreach (session('errors')->all() as $error)
                                <li>{{ $error }}</li>
                        @endforeach
                               </ul>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-secondary col-3 mx-auto fs-4">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            
        </div>
    </div>
    </body>
</html>     --}}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログインページ</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <header class="d-flex justify-content-between align-items-center p-3">
        <nav class="mt-5 ms-auto">
            <a href="{{ route('admin.show.register') }}" class="me-5 text-dark text-decoration-none fs-5">新規会員登録はこちら</a>
        </nav>
    </header>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">管理画面ログイン</h1>
            <div class="mt-5">
                <form method="POST" action="{{ route('admin.show.login') }}" novalidate>
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('auth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-5">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('auth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-secondary col-3 mx-auto fs-4">
                                {{ __('ログイン') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>