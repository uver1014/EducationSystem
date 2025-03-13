@extends('admin.layouts.app')
@section('title','お知らせ変更')
@section('content')

<!-- Page Content -->
<div class="container mt-5 p-lg-5 bg-light">

<div class="form-group row">
        <div class="mt-5">
            <a href="{{ route('admin.show.article.list') }}">戻る</a>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <h2>お知らせ変更</h2>
    </div>

    <form method="POST" action="{{ route('admin.article.edit', $article->id) }}" onSubmit="return checkSubmit()" enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <input type="hidden" name="_method" value="put">

        @if (session('message'))
        <div class="text-danger">
            {{ session('message') }}
        </div>
        @endif
        <div class="form-row">
            <div class="col-md-6 mb-3">
            @if($errors->has('posted_date'))
            <div class="text-danger">
                {{ $errors->first('posted_date')}}
            </div>
            @endif
                <label for="posted_date">投稿日時</label>
                <input type="text" class="form-control" id="posted_date" name="posted_date" value="{{ $article->posted_date }}">
            </div>
          
        
        </div>


        <div class="form-row">
            <div class="col-md-3 mb-3">
            @if($errors->has('title'))
            <div class="text-danger">
                {{ $errors->first('title')}}
            </div>
            @endif
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
            </div>
            
        </div>


        <div class="form-group mb-4">
        @if($errors->has('article_contents'))
            <div class="text-danger">
                {{ $errors->first('article_contents')}}
            </div>
            @endif
            <label for="article_contents">本文</label>
            <textarea class="form-control" id="article_contents" name="article_contents" rows="3">{{ $article->article_contents }}</textarea>
           
        </div>


        <!--ボタンブロック-->
        <div class="form-group row">
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">更新</button>
                
            </div>
        </div>
        

    </form>

</div>
</body>

</html>

@endsection