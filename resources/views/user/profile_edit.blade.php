

<!-- Page Content -->
<div class="container mt-5 p-lg-5 bg-light">
    <div class="col-md-8 col-md-offset-2">
        <h2>プロフィール変更</h2>
    </div>

    <form method="POST"  onSubmit="return checkUpdate()" enctype='multipart/form-data'>
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
                <input type="text" class="form-control" id="name" name="name" value="{{ $auth->name }}">
            </div>
          
        </div>

        
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="kana">カナ</label>
                <input type="text" class="form-control" id="kana" name="kana" value="{{ $auth->kana }}">
            </div>
          
        </div>

        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $auth->email }}">
            </div>
          
        </div>


        <div class="form-group mb-3">
            <label for="comment">パスワード変更</label>
            <a href="" button type="submit" >ﾊﾟｽﾜｰﾄﾞ変更</a>
        
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
