@extends('user.layouts.app')
@section('title','パスワード変更')
@section('content')

<!-- Page Content -->
<div class="container mt-5 p-lg-5 bg-light">

    <div class="form-group row">
        <div class="mt-5">
            <a href="{{ route('user.show.profile') }}">戻る</a>
        </div>
    </div>
    
    <div class="col-md-8 col-md-offset-2">
        <h2>パスワード変更</h2>
    </div>

    <form method="POST" action="{{ route('user.password.edit') }}" onSubmit="return checkUpdate()" enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <input type="hidden" name="_method" value="put">
        @if (session('message'))
        <div class="text-danger">
            {{ session('message') }}
        </div>
        @endif


        <!-- 現在のパスワード -->
        <div class="form-group">
                <label for="current_password">現在のパスワード</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>

            <!-- 新しいパスワード -->
            <div class="form-group">
                <label for="new_password">新しいパスワード</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>

            <!-- 新しいパスワード確認 -->
            <div class="form-group">
                <label for="new_password_confirmation">新しいパスワード（確認）</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">変更</button>
        </form>
    </div>


    </form>

</div>
</body>

</html>
@endsection