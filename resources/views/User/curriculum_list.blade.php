@extends('user.layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('user.top')}}" style="text-decoration:none; color:black; font-size:1rem;">←戻る</a>
        <div class="row">
            <div class="col-4">
                <div class="d-flex justify-content:center">
                    <a href="{{ route('user.curriculums.changeMonth',['direction' => 'prev','month' => $currentMonth, 'grade' => $currentGradeId]) }}" class="btn">◀</a>
                    <h4>{{ \Carbon\Carbon::parse($currentMonth)->format('Y年m月') }}スケジュール</h4>
                    <a href="{{ route('user.curriculums.changeMonth',['direction' => 'next','month' => $currentMonth, 'grade' => $currentGradeId]) }}" class="btn">▶</a>
                </div>
            </div>
            <div class="col-4">
                @php
                // 現在表示している学年のボタンの色を取得
                $currentGradeBtnClass = match (true) {
                    $currentGradeId <= 6 => 'btn-info', //小学1年生～6年生
                    $currentGradeId <= 9 => 'btn-primary', //中学1年生～3年生
                    $currentGradeId <= 12 => 'btn-success' //高校1年生～3年生
                    };
                @endphp
                <h3 class="btn {{ $currentGradeBtnClass }}" style="color: white">{{ $curriculums->first()->grade->name }}</h1>
            </div>
        </div>
    </div>
    <div class="main-container" style="width: 90%;margin:0 auto;display:flex;justify-content:space-between;">
        <div class="left-menu d-flex flex-column my-3" style="width: 20%;padding:10px;">
            @foreach (App\Models\Grade::all() as $grade)
                @php
                    //ボタンのスタイル　学年ごとの設定
                    $btnClass = match (true) {
                        $grade->id <= 6 => 'btn-info', //小学1年生～6年生
                        $grade->id <= 9 => 'btn-primary', //中学1年生～3年生
                        $grade->id <= 12 => 'btn-success' //高校1年生～3年生
                    };
                @endphp
                <a href="{{ route('user.curriculums.changeGrade',['grade' => $grade, 'month' => $currentMonth]) }}" class="btn {{ $btnClass }} mb-3" style="color: white;width:120px;border-radius:20px;">
                    {{ $grade->name }}
                </a>
            @endforeach
        </div>
        <div class="main-contents my-3" style="width: 80%;padding:10px;"> 
            <div class="row row-cols-3">
                @foreach ($curriculums as $curriculum)
                    <div class="col d-flex col-md-4">
                        <div class="card flex-fill mb-3" style="min-height: 250px;">
                            <img src="{{ $curriculum->thumbnail}}" class="card-img-top" style="width: 20opx;height:150px;padding:15px;margin:10px auto;display:block;" alt="{{ $curriculum->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $curriculum->title }}</h5>
                                <ul style="padding-left: o">
                                    @if ($curriculum->alway_delivery_flg)
                                           <a href="#" class="card-text" style="text-decoration: none;color:black">常時公開</a>
                                    @else
                                    @foreach ($curriculum->deliveryTimes as $delivery)
                                    <li style="list-style: none">
                                        <a href="#" class="card-text" style="text-decoration: none;color:black">
                                            {{ \Carbon\Carbon::parse($curriculum->deliveryTimes->first()->delivery_from)->format('m月d日 H:i')  }} 
                                            ～
                                            {{ \Carbon\Carbon::parse($curriculum->deliveryTimes->first()->delivery_to)->format('H:i')  }}
                                        </a>        
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>    
                            </div>    
                        </div>
                    </div>
                    
                @endforeach
            </div>    
        </div>
    </div>    
@endsection   