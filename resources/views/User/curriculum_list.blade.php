@extends('user.layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('user.top')}}" class="text-decoration-none text-dark fs-5">←戻る</a>
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center">
                    <button id="prevMonth" class="btn me-2">◀</button>
                    <h4 class="mb-0" id="currentMonth">{{ \Carbon\Carbon::parse($currentMonth)->format('Y年m月') }}スケジュール</h4>
                    <button id="nextMonth" class="btn ms-2">▶</button>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                @php
                    // 現在表示している学年のボタンの色を取得
                    $currentGradeBtnClass = match (true) {
                        $currentGradeId <= 6 => 'btn-grade-elementary', //小学1年生～6年生
                        $currentGradeId <= 9 => 'btn-grade-middle', //中学1年生～3年生
                        $currentGradeId <= 12 => 'btn-grade-high' //高校1年生～3年生
                    };
                @endphp
                <h3 class="btn {{ $currentGradeBtnClass }} text-white w-50 mx-auto" id="currentGradeName" data-grade-id="{{ $currentGradeId }}">
                    {{ $curriculums->isNotEmpty() ? $curriculums->first()->grade->name : '学年' }}
                </h3>
            </div>
        </div>
    </div>
    <div class="container-fluid py-1 mt-5">
        <div class="row justify-content-between">
            <div class="col-md-3 d-flex flex-column">
                @foreach (App\Models\Grade::all() as $grade)
                    @php
                        //ボタンのスタイル　学年ごとの設定
                        $btnClass = match (true) {
                            $grade->id <= 6 => 'btn-grade-elementary', //小学1年生～6年生
                            $grade->id <= 9 => 'btn-grade-middle', //中学1年生～3年生
                            $grade->id <= 12 => 'btn-grade-high' //高校1年生～3年生
                        };
                    @endphp
                    <button class="changeGrade btn {{ $btnClass }} text-white mb-3 rounded-pill w-50 mx-auto"
                            data-grade-id="{{ $grade->id }}"
                            data-grade-name="{{ $grade->name }}">
                        {{ $grade->name }}
                    </button>
                @endforeach
            </div>
            <div class="col-md-8 me-5" id="curriculumList">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @forelse ($curriculums as $curriculum)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ $curriculum->thumbnail}}" class="card-img-top p-3 mx-auto d-block" style="max-width: 300px; max-height: 250px; object-fit: contain;" alt="{{ $curriculum->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $curriculum->title }}</h5>
                                    @if ($curriculum->alway_delivery_flg)
                                        <p class="card-text"><a href="{{ route('user.show.delivery', ['curriculum' => $curriculum->id]) }}" class="text-decoration-none text-dark">常時公開</a></p>
                                    @else
                                        @php
                                            $hasDeliveryInCurrentMonth = false;
                                        @endphp
                                        <ul class="list-unstyled">
                                            @foreach ($curriculum->deliveryTimes as $delivery)
                                                @if (\Carbon\Carbon::parse($delivery->delivery_from)->format('Y-m') === \Carbon\Carbon::parse($currentMonth)->format('Y-m'))
                                                    <li>
                                                        <a href="{{ route('user.show.delivery', ['curriculum' => $curriculum->id]) }}" class="card-text text-decoration-none text-dark">
                                                            {{ \Carbon\Carbon::parse($delivery->delivery_from)->format('m月d日 H:i') }}
                                                            ～
                                                            {{ \Carbon\Carbon::parse($delivery->delivery_to)->format('m月d日 H:i') }}
                                                        </a>
                                                    </li>
                                                    @php
                                                        $hasDeliveryInCurrentMonth = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if (!$hasDeliveryInCurrentMonth)
                                                <li>
                                                    <span class="card-text text-secondary">配信予定なし</span>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">該当するカリキュラムはありません。</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="currentMonthHidden" value="{{ $currentMonth }}">
@endsection