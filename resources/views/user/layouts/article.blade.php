@extends('user.layouts.app')
@section('title', 'お知らせ詳細')
@section('content')

<div class="form-group row">
    <div class="mt-5">
    <a href="{{ route('show.top') }}">戻る</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <span>{{ $article->created_at }}</span>
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->article_contents }}</p>
    </div>
</div>

</body>
</html>