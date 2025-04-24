@extends('admin.layouts.app')

@section('content')
    <a href="{{ route('admin.top')}}" style="text-decoration:none; color:black; font-size:1rem;">←戻る</a>
    <div class="container">
        <h1>バナー管理</h1>
        <form action="#" method="POST" enctype="multipart/form-data" class="mb-3">
            @csrf
            <input type="file" name="image" class="form-control">
            <button type="submit" class="btn btn-primary mt-2">登録</button>
        </form>
        <h2 class="mt-4">登録済みバナー</h2>
        <ul>
            @foreach ($banners as $banner)
                <li>
                    <img src="{{ asset($banner->image) }}" alt="バナー画像" style="width: 200px;">
                    <form action="#" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection 