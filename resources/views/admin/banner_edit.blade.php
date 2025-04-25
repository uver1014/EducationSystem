@extends('admin.layouts.app')

@section('content')
    <a href="{{ route('admin.top')}}" style="text-decoration:none; color:black; font-size:1rem;">←戻る</a>
    <div class="container">
        <h1>バナー管理</h1>
        @foreach ($banners as $banner)
            <div>
            {{-- 画像表示 --}}
            <img src="{{ asset($banner->image)}}" alt="Banner Image" style="width: 200px">
            {{-- 画像削除 --}}
            <form action="{{ route('admin.delete.banner',$banner->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
            </div>
        @endforeach

        {{-- ファイル選択と追加 --}}
        <form action="{{ route('admin.add.banner') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" accept="image/*">
            <button type="submit" class="btn btn-secondary">登録</button>
        </form>
        {{-- <form action="#" method="POST" enctype="multipart/form-data" class="mb-3">
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
        </ul> --}}
    </div>
@endsection 