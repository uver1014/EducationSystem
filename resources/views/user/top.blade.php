@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">ユーザートップ</h1>

    <!-- バナー画像エリア -->
    <div class="banner-container">
        <div class="banner-slider">
            @foreach ($banners as $banner)
                <img src="{{ asset('storage/'.$banner->image) }}" alt="バナー画像" class="banner-image">
            @endforeach
        </div>
        <div class="banner-indicators">
            @foreach ($banners as $banner)
                <span class="indicator"></span>
            @endforeach
        </div>
    </div>

    <!-- お知らせ一覧 -->
    <div class="notice-section">
        <h2>お知らせ</h2>
        <div class="notice-box">
            <table class="notice-table">
                @foreach ($articles as $article)
                    <tr>
                        <td class="date">{{ $article->posted_date }}</td>
                        <td class="title">{{ $article->title }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
