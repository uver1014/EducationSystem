@extends('user.layouts.app')
@section('title','授業進捗画面')
@section('content')

<div class="container">
    <div class="row">
        <div>
            <label for="profile_image">
                <img src="{{ asset( $user->profile_image ) }}" class="profile_image">
            </label>

            <label for="name">
                <div class="form-group">{{ $user->name }}さんの授業進捗</div><br>
                <div class="form-group">現在の学年：{{ $user->grade->name }}</div>
            </label>
        </div>
    </div>

    <div class="row">

        @foreach($grades as $grade)
        <div class="col-md-4 mb-3">
            <div class="list-group">
                <label for="gradesName">{{ $grade->name }}</label>
                @if(isset($curriculums[$grade->id]) && $curriculums[$grade->id]->isNotEmpty())
                
                @foreach($curriculums[$grade->id] as $curriculum)
                <div class="curriculum-block">
                    @if($curriculum->grade_id <= $user->grade->id || $curriculum->is_completed)
                     <div class="pass">受講済み</div>
                      <a class="curriculum_title" href="{{ route('user.show.delivery') }}">{{ $curriculum->title }}</a>
                    @else
                     <span class="disabled">{{ $curriculum->title }}</span>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection