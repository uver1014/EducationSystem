@extends('layouts.app')

@section('title', '授業配信')

@section('content')
<div class="container">
    <h1 class="page-title">授業配信</h1>

    <!-- 動画エリア -->
    <div class="video-container">
        <video controls>
            <source src="{{ $lesson->video_url }}" type="video/mp4">
            お使いのブラウザは動画をサポートしていません。
        </video>
    </div>

    <!-- 授業情報 -->
    <div class="lesson-details">
        <p class="lesson-title">{{ $lesson->title }}</p>
        <p class="lesson-content">{{ $lesson->description }}</p>
    </div>

    <!-- 受講ボタン -->
    <div class="button-container">
        @if ($isAvailable)
            <button id="completeButton" class="lesson-btn">受講しました</button>
        @else
            <button class="lesson-btn disabled" disabled>配信期間外</button>
        @endif
    </div>
</div>

<script>
    document.getElementById('completeButton')?.addEventListener('click', function() {
        fetch("{{ route('lesson.complete', $lesson->id) }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            document.getElementById('completeButton').textContent = "受講済";
            document.getElementById('completeButton').disabled = true;
        });
    });
</script>
@endsection
