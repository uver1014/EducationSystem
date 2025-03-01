@extends('admin.layouts.app')
@section('title','お知らせ一覧')
@section('content')

<div class="container">

    <div class="form-group row">
        <div class="mt-5">
            <a href="{{ route('admin.top') }}">戻る</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8 offset-md-4">
            <h2>お知らせ一覧</h2>
            @if(session('message'))
            <div class=" text-danger">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th><a href="{{ route('admin.show.article.create') }}" button type="button" class="btn btn-success">新規登録</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr id="tr_{{ $article->id }}">
                <td>{{ $article->posted_date }}</td>
                <td>{{ $article->title }}</td>
                <td><a href="{{ route('admin.show.article.edit', $article->id) }}" class="btn btn-primary">詳細</a></td>
                <td>
                    <form method="POST" action="{{ route('admin.article.delete', $article->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger">削除</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection