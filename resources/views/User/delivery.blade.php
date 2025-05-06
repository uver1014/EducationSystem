@extends('user.layouts.app')

@section('content')
    <div class="container">
        <h1>配信ページ</h1>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $curriculum->title }}</h2>
                @if ($curriculum->thumbnail)
                    <img src="{{ $curriculum->thumbnail }}" class="img-fluid mb-3" alt="{{ $curriculum->title }}">
                @endif
                <p class="card-text">
                    @if ($curriculum->alway_delivery_flg)
                        常時公開
                    @else
                        配信期間：
                        @if ($curriculum->deliveryTimes->isNotEmpty())
                            <ul>
                                @foreach ($curriculum->deliveryTimes as $delivery)
                                    <li>
                                        {{ \Carbon\Carbon::parse($delivery->delivery_from)->format('Y年m月d日 H:i') }}
                                        ～
                                        {{ \Carbon\Carbon::parse($delivery->delivery_to)->format('Y年m月d日 H:i') }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            配信予定はありません
                        @endif
                    @endif
                </p>
                <p class="card-text">
                    {{-- 必要に応じてカリキュラムの詳細などを表示 --}}
                </p>
                {{-- 他のカリキュラム情報もここに表示できます --}}
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('user.show.curriculum', ['month' => \Carbon\Carbon::now()->format('Y-m'), 'grade' => $curriculum->grade_id]) }}" class="text-decoration-none text-dark fs-5">← スケジュールに戻る</a>
        </div>
    </div>
@endsection