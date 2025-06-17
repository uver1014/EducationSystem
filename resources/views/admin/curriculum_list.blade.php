@extends('layouts.app')
@section('title', '授業一覧')
@section('content')
    <a href="" onclick="history.back()" class="back">←戻る</a>

    <h1>授業一覧</h1>
        <div class="register-container">
            <a href="{{ route('admin.show.curriculum.create') }}" class="register-class">新規登録</a>
            <p class="selected-grade">学年を選択してください</p>
        </div>

        <div class="curriculum-list">
            <div class="grade">
                @foreach ($grades as $grade)
                    <button class="grade-btn" data-grade="{{ $grade->id }}">
                        {{ $grade->name }}
                    </button>
                @endforeach
            </div>

            <div id="curriculum"></div>

            <script>
                function formatDateTime(datetime) {
                    const date = new Date(datetime);
                    const month = date.getMonth() + 1;
                    const day = date.getDate();
                    const hour = date.getHours().toString().padStart(2, '0');
                    const minutes = date.getMinutes().toString().padStart(2, '0');
                    return `${month}月${day}日 ${hour}:${minutes}`;
                }

                $(document).ready(function() {
                    $(".grade-btn").click(function() {
                        let selectedText = $(this).text();
                        $(".selected-grade").text(selectedText);

                        let gradeId = $(this).data("grade");

                        $.ajax({
                            url: "{{ url('admin/curriculums') }}/" + gradeId, 
                            type: "GET",
                            dataType: "json",
                            success: function (curriculums) {
                                console.log("取得データ:", curriculums);
                                if (curriculums.length === 0) {
                                        console.log("カリキュラムデータなし");
                                }

                                updateCurriculumList(curriculums);
                            },
                            error: function () {
                                $("#curriculum").html("<p>データ取得に失敗しました。</p>");
                            }
                        });
                    });

                    function updateCurriculumList(curriculums) {
                        console.log("受け取ったカリキュラムデータ:", curriculums);

                        curriculums.forEach(c => {
                            console.log(`カリキュラム: ${c.title}`);
                            console.log(`常時公開フラグ: ${c.alway_delivery_flg}`);

                            if (c.delivery_times && c.delivery_times.length > 0) {
                                c.delivery_times.forEach((dt, index) => {
                                    console.log(`公開開始日 ${index + 1}: ${dt.delivery_from || "なし"}`);
                                    console.log(`公開終了日 ${index + 1}: ${dt.delivery_to || "なし"}`);
                                });
                            }
                        });

                        const curriculumEditBaseUrl = "{{ url('admin/curriculum_edit') }}";
                        const deliveryEditBaseUrl = "{{ url('admin/delivery_time_edit') }}";

                        let html = curriculums.length
                            ? `<div class="curriculum">` + 
                                curriculums.map(c => {
                                    return `
                                    <div class="curriculum-content">
                                        <img src="${c.thumbnail}" alt="授業サムネイル" class="thumbnail">
                                        <p class="video-title">${c.title}</p>

                                        ${
                                            c.alway_delivery_flg == 0 && c.delivery_times && c.delivery_times.length
                                                ? c.delivery_times.map(dt => {
                                                    return `<p class="video-time">${formatDateTime(dt.delivery_from)} ～ ${formatDateTime(dt.delivery_to)}</p>`;
                                                }).join("")
                                                : `<p class="video-time">常時公開</p>`
                                        }

                                        <a href="${curriculumEditBaseUrl}/${c.id}"><button class="edit-class-btn">授業内容編集</button></a>
                                        <a href="${deliveryEditBaseUrl}/${c.id}"><button class="edit-schedule-btn">配信日時編集</button></a>
                                    </div>
                                `;
                            }).join("") +
                            `</div>`
                            : "<p>カリキュラムがありません。</p>";

                        $("#curriculum").html(html);
                    }
                });
            </script>
@endsection


