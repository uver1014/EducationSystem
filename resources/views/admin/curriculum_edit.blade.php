<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @vite(['resources/css/app.css'])
        <title>授業設定</title>
    </head>
    <body>
    @extends('layouts.app')
    @section('content')

        <a href="{{ route('show.curriculum.list') }}?grade={{ $curriculum->grade_id }}" class="back">←戻る</a>
            <h1>授業設定</h1>
        
                
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div id="ajax-success-message" class="alert alert-success" style="display: none;"></div>
            <div id="ajax-error-message" class="alert alert-danger" style="display: none;"></div>

            @if($curriculum->id)
            <form action="{{ route('curriculum.update', ['id' => $curriculum->id]) }}" method="POST" enctype="multipart/form-data" id="curriculum-edit-form">  
                @csrf
                <div class="form-block-thumbnail">
                    <div class="thumbnail-preview">
                            <img class="thumbnail-image" src="{{ asset($curriculum->thumbnail) }}" alt="サムネイル画像" width="150">
                    </div>
                    <div class="thumbnail-controls">
                        <label class="label-thumbnail">サムネイル</label>
                        <input type="file" name="thumbnail">
                    </div>
                </div>

                <div class="curriculum-edit">
                    <div class="form-block">
                        <label class="edit-title" for="edit-title">学年</label>
                            <select name="grade">
                                <option value="1" {{ old('grade', $curriculum->grade_id) == 1 ? 'selected' : '' }}>小学1年</option>
                                <option value="2" {{ old('grade', $curriculum->grade_id) == 2 ? 'selected' : '' }}>小学2年</option>
                                <option value="3" {{ old('grade', $curriculum->grade_id) == 3 ? 'selected' : '' }}>小学3年</option>
                                <option value="4" {{ old('grade', $curriculum->grade_id) == 4 ? 'selected' : '' }}>小学4年</option>
                                <option value="5" {{ old('grade', $curriculum->grade_id) == 5 ? 'selected' : '' }}>小学5年</option>
                                <option value="6" {{ old('grade', $curriculum->grade_id) == 6 ? 'selected' : '' }}>小学6年</option>
                                <option value="7" {{ old('grade', $curriculum->grade_id) == 7 ? 'selected' : '' }}>中学1年</option>
                                <option value="8" {{ old('grade', $curriculum->grade_id) == 8 ? 'selected' : '' }}>中学2年</option>
                                <option value="9" {{ old('grade', $curriculum->grade_id) == 9 ? 'selected' : '' }}>中学3年</option>
                                <option value="10" {{ old('grade', $curriculum->grade_id) == 10 ? 'selected' : '' }}>高校1年</option>
                                <option value="11" {{ old('grade', $curriculum->grade_id) == 11 ? 'selected' : '' }}>高校2年</option>
                                <option value="12" {{ old('grade', $curriculum->grade_id) == 12 ? 'selected' : '' }}>高校3年</option>
                            </select>
                    </div>

                    <div class="form-block">
                        <label class="edit-title" for="edit-title">授業名</label>
                        <input type="text" name="title" value="{{ old('title', $curriculum->title) }}">
                    </div>

                    <div class="form-block">
                        <label class="edit-title" for="edit-title">動画URL</label>
                        <input type="text" name="video_url" value="{{ old('video_url', $curriculum->video_url) }}">
                    </div>

                    <div class="form-block">
                        <label class="edit-title" for="edit-title">授業概要</label>
                        <textarea name="description">{{ old('description', $curriculum->description) }}</textarea>
                    </div>

                    <div class="form-block-flg">
                        <input type="checkbox" name="alway_delivery_flg" class="alway-delivery-flg"  value="1"{{ old('alway_delivery_flg', $curriculum->alway_delivery_flg) ? 'checked' : '' }}>
                        <label class="edit-title" for="edit-title">常時公開</label>
                    </div>

                    <button type="submit" class="register">登録</button>
                </div>
            </form>

            @else
            <form action="{{ route('curriculum.store') }}" method="POST" enctype="multipart/form-data" id="curriculum-create-form">
                @csrf

                <div class="form-block-thumbnail">
                    <div class="thumbnail-controls">
                        <label class="label-thumbnail">サムネイル</label>
                        <input type="file" name="thumbnail">
                    </div>
                </div>

                <div class="curriculum-edit">
                    <div class="form-block">
                        <label class="edit-title" for="grade">学年</label>
                        <select name="grade" id="grade">
                            <option value="1">小学1年</option>
                            <option value="2">小学2年</option>
                            <option value="3">小学3年</option>
                            <option value="4">小学4年</option>
                            <option value="5">小学5年</option>
                            <option value="6">小学6年</option>
                            <option value="7">中学1年</option>
                            <option value="8">中学2年</option>
                            <option value="9">中学3年</option>
                            <option value="10">高校1年</option>
                            <option value="11">高校2年</option>
                            <option value="12">高校3年</option>
                        </select>
                    </div>

                    <div class="form-block">
                        <label class="edit-title" for="title">授業名</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}">
                    </div>

                    <div class="form-block">
                        <label class="edit-title" for="video_url">動画URL</label>
                        <input type="text" name="video_url" id="video_url" value="{{ old('video_url') }}">
                    </div>

                    <div class="form-block">
                        <label class="edit-title" for="description">授業概要</label>
                        <textarea name="description" id="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-block-flg">
                        <input type="checkbox" name="alway_delivery_flg" id="alway_delivery_flg" value="1" {{ old('alway_delivery_flg') ? 'checked' : '' }}>
                        <label class="edit-title" for="alway_delivery_flg">常時公開</label>
                    </div>

                    <button type="submit" class="register">新規登録</button>
                </div>
            </form>
            @endif

            <script>
                let curriculumId = {{ $curriculum->id }};

                 $(document).ready(function() {
                    $('#curriculum-edit-form').submit(function(e) {
                        e.preventDefault(); 

                        let form = $(this);
                        let url = form.attr('action'); 
                        let method = form.attr('method') || 'POST'; 

                        $.ajax({
                            url: "{{ url('curriculum_update') }}/" + curriculumId,
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function(response) {
                                $('#ajax-success-message').text(response.message).show();

                            $.ajax({
                                url: "{{ url('curriculums') }}/" + response.grade_id,
                                type: 'GET',
                                dataType: 'json',
                                success: function(curriculums) {
                                    updateCurriculumList(curriculums);
                                },
                                    error: function() {
                                        alert('カリキュラム一覧の取得に失敗しました。');
                                    }
                                });
                            },

                                error: function(xhr) {
                            let errorMessage = '更新に失敗しました。';

                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                                }
                            }
                        });
                    });
                });
            </script>
         @endsection
    </body>
</html>

