@extends('layouts.app')

@section('title', '授業配信')

@section('content')
    <style>
        .container {
            width: 80%;
            margin: 20px auto;
            text-align: center;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            color: #3F51B5;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 5px 10px;
            border: 1px solid #3F51B5;
            border-radius: 5px;
        }

        .video-container {
            margin: 0 auto;
            width: 60%;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        video {
            width: 100%;
            border-radius: 10px;
        }

        .lesson-details {
            margin-top: 15px;
            text-align: center;
        }

        .lesson-grade {
            display: inline-block;
            background-color: #64B5F6;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .lesson-title {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }

        .lesson-content {
            font-size: 16px;
            color: #333;
            margin-top: 10px;
        }

        .button-container {
            text-align: right;
            margin-top: 20px;
        }

        .lesson-btn {
            background-color: #E57373;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .lesson-btn:hover {
            background-color: #D84315;
        }

        .lesson-btn.disabled {
            background-color: #BDBDBD;
            cursor: not-allowed;
        }
    </style>

    <div class="container">
        <h1 class="page-title">授業配信</h1>

        <!-- 戻るボタン -->
        <a href="{{ route('user.show.top') }}" class="back-btn">← 戻る</a>

        <!-- 動画エリア -->
        <div class="video-container">
            @if ($isAvailable)
                <video controls>
                    <source src="{{ $lesson->video_url }}" type="video/mp4">
                    お使いのブラウザは動画をサポートしていません。
                </video>
            @else
                <p>この動画は現在閲覧できません。</p>
            @endif
        </div>

        <!-- 授業情報 -->
        <div class="lesson-details">
            <p class="lesson-grade">学年: {{ $lesson->grade->name }}</p>
            <p class="lesson-title">{{ $lesson->title }}</p>
            <p class="lesson-content">{{ $lesson->description }}</p>
        </div>

        <!-- 受講ボタン -->
        <div class="button-container">
            @if ($isCompleted)
                <button class="lesson-btn disabled" disabled>受講済</button>
            @elseif ($isAvailable)
                <button id="completeButton" class="lesson-btn">受講しました</button>
            @else
                <button class="lesson-btn disabled" disabled>配信期間外</button>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const completeButton = document.getElementById('completeButton');

            if (completeButton) {
                completeButton.addEventListener('click', function () {
                    console.log("受講ボタンがクリックされました");

                    fetch("{{ route('user.complete.delivery', $lesson->id) }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({})
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log("サーバー応答:", data);
                            alert(data.message);

                            // ボタンを「受講済」に変更
                            completeButton.textContent = "受講済";
                            completeButton.disabled = true;
                            completeButton.classList.add("disabled");
                        })
                        .catch(error => console.error("エラー:", error));
                });
            }
        });
    </script>
@endsection