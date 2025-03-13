@extends('layouts.app')

@section('content')
<style>
    .container {
        width: 80%;
        margin: 20px auto;
        text-align: center;
    }

    /* バナースライダー */
    .banner-container {
        position: relative;
        width: 100%;
        max-width: 800px;
        height: 300px;
        margin: 20px auto;
        overflow: hidden;
        background-color: #f9f9f9;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .banner-slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: calc(100% * {{ count($banners) }});
    }

    .banner-image {
        width: 100%;
        max-width: 800px;
        height: 100%;
        object-fit: contain;
        flex-shrink: 0;
        border-radius: 10px;
    }

    /* インジケーター */
    .banner-indicators {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .indicator {
        width: 10px;
        height: 10px;
        background-color: #6d4c41;
        border-radius: 50%;
        margin: 0 5px;
        cursor: pointer;
    }

    .indicator.active {
        background-color: #ff7043;
    }

    /* お知らせ */
    .notice-section {
        margin-top: 30px;
        text-align: left;
    }

    .notice-box {
        border-radius: 10px;
        padding: 10px;
        background-color: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .notice-table {
        width: 100%;
        border-collapse: collapse;
    }

    .notice-table td {
        padding: 10px;
    }

    .date {
        width: 15%;
        color: gray;
    }

    .title {
        font-weight: bold;
    }

    .content {
        padding: 5px 0;
        color: #333;
    }
</style>

<div class="container">
    <h1 class="page-title">ユーザートップ</h1>

    <!-- バナー画像エリア -->
    <div class="banner-container">
        <div class="banner-slider">
            @foreach ($banners as $banner)
                <img src="{{ asset('storage/'.$banner->image) }}" alt="バナー画像" class="banner-image">
            @endforeach
        </div>
    </div>
    <div class="banner-indicators">
        @foreach ($banners as $index => $banner)
            <span class="indicator" data-index="{{ $index }}"></span>
        @endforeach
    </div>

    <!-- お知らせ一覧 -->
    <div class="notice-section">
        <h2>お知らせ</h2>
        <div class="notice-box">
            <table class="notice-table">
                @foreach ($articles as $article)
                    <tr>
                        <td class="date">{{ \Carbon\Carbon::parse($article->posted_date)->format('Y/m/d') }}</td>
                        <td>
                            <p class="title">{{ $article->title }}</p>
                            <p class="content">{{ $article->article_contents }}</p>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let currentIndex = 0;
        const slides = document.querySelectorAll(".banner-image");
        const slider = document.querySelector(".banner-slider");
        const indicators = document.querySelectorAll(".indicator");

        if (slides.length === 0) {
            console.warn("スライド画像が見つかりません。");
            return;
        }

        function updateSlider(index) {
            const slideWidth = document.querySelector(".banner-container").clientWidth;
            slider.style.transform = `translateX(${-index * slideWidth}px)`;

            indicators.forEach((indicator, i) => {
                indicator.classList.toggle("active", i === index);
            });
        }

        indicators.forEach((indicator, i) => {
            indicator.addEventListener("click", function () {
                currentIndex = i;
                updateSlider(currentIndex);
            });
        });

        setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlider(currentIndex);
        }, 5000);
    });
</script>

@endsection
