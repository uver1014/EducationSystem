@extends('user.layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('user.top')}}" style="text-decoration:none; color:black; font-size:1rem;">←戻る</a>
        <div class="row">
            <div class="col-4">
                <div class="d-flex justify-content:center">
                    <a href="#" class="btn">◀</a>
                    <h4>{{ \Carbon\Carbon::parse($currentMonth)->format('Y年m月') }}スケジュール</h4>
                    <a href="#" class="btn">▶</a>
                </div>
            </div>
            <div class="col-4">
                <h3 class="btn btn-info" style="color: white">{{ $curriculums->first()->grade->name }}</h1>
            </div>
        </div>
    </div>
    <div class="main-container" style="width: 90%;margin:0 auto;display:flex;justify-content:space-between;">
        <div class="left-menu d-flex flex-column my-3" style="width: 20%;padding:10px;">
            @foreach (App\Models\Grade::all() as $grade)
                <a href="#" class="btn btn-info mb-2" style="color: white">
                    {{ $grade->name }}
                </a>
            @endforeach
        </div>
        <div class="main-contents" style="width: 80%;padding:10px;"> 
            <div class="row">
                @foreach ($curriculums as $curriculum)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" class="card-img-top" alt="{{ $curriculum->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $curriculum->title }}</h5>
                                <a href="#" class="card-text">
                                    {{ \Carbon\Carbon::parse($curriculum->deliveryTimes->first()->delivery_from)->format('m月d日 H:i')  }} 
                                    ～
                                    {{ \Carbon\Carbon::parse($curriculum->deliveryTimes->first()->delivery_to)->format('H:i')  }}
                                </a>
                            </div>    
                        </div>
                    </div>
                    
                @endforeach
            </div>    
        </div>
    </div>    
@endsection   