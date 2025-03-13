@extends('user.layouts.app')
@section('title','プロフィール変更')
@section('content')

<!-- Page Content -->
<div class="container mt-5 p-lg-5 bg-light">
    <div class="form-group row">
        <div class="mt-5">
            <a href="{{ route('user.show.top') }}">戻る</a>
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">
        <h2>プロフィール変更</h2>
    </div>

    <form method="POST" action="{{ route('user.profile.edit') }}" onSubmit="return checkUpdate()" enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <input type="hidden" name="_method" value="put">
        @if (session('message'))
        <div class="text-danger">
            {{ session('message') }}
        </div>
        @endif

        <div class="form-row">
            <div class="custom-file mb-3">
                <label for="profile_image">プロフィール画像</label>
                <input type="file" class="custom-file-input" id="profile_image" name="profile_image" value="{{ old('profile_image') }}">
                {{--<label class="productFile" for="customFile">ファイル選択...</label>--}}

            </div>
        </div>


        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="name">ユーザーネーム</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
            </div>
            @if($errors->has('name'))
            <div class="text-danger">
                {{ $errors->first('name')}}
            </div>
            @endif
        </div>


        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="name_kana">カナ</label>
                <input type="text" class="form-control" id="name_kana" name="name_kana" value="{{ Auth::user()->name_kana }}">
            </div>
            @if($errors->has('name_kana'))
            <div class="text-danger">
                {{ $errors->first('name_kana')}}
            </div>
            @endif
        </div>

        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
            </div>
            @if($errors->has('email'))
            <div class="text-danger">
                {{ $errors->first('email')}}
            </div>
            @endif
        </div>


        <div class="form-group mb-3">
            <label for="comment">パスワード変更</label>
            <a href="{{ route('user.show.password.edit') }}" button type="submit">ﾊﾟｽﾜｰﾄﾞ変更</a>

        </div>

        <div class="form-group row">
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">登録</button>
            </div>
        </div>




    </form>

</div>
</body>

</html>
@endsection