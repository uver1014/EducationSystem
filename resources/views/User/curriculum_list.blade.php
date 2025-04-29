@extends('user.layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('user.top')}}" style="text-decoration:none; color:black; font-size:1rem;">←戻る</a>
        <div class="row">
            <div class="col-4">
                <h3>◀ 2025年4月スケジュール ▶</h1>
            </div>
            <div class="col-4">
                <h3 class="btn btn-info" style="color: white">ここにユーザーの学年を表示</h1>
            </div>
        </div>
    </div>
    <div class="main-container" style="width: 90%;margin:0 auto;display:flex;justify-content:space-between;">
        <div class="left-menu" style="width: 20%;padding:10px;background-color:#faa;">
        左メニュー　ここに学年一覧を表示 背景色は範囲を分かりやすくするために設定
        </div>
        <div class="main-contents" style="width: 80%;padding:10px;background-color:#ccc;"> 
        メインコンテンツ　ここに授業一覧を表示　背景色は範囲を分かりやすくするために設定
        </div>
    </div>    
@endsection   