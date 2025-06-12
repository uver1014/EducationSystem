<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @vite(['resources/css/app.css'])
        <title>配信日時設定</title>
    </head>
    
    <body>
    @extends('layouts.app')
    @section('content')

        <a href="{{ route('admin.show.curriculum.list') }}?grade={{ $curriculum->grade_id }}"  class="back">←戻る</a>
            <h1>配信日時設定</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <p>{{ $title }}</p>

            <form action="{{ route('admin.delivery.update', $curriculum_id) }}" method="POST">
                @csrf
                <div id="delivery-container">
                    @foreach ($deliverytimes as $time)
                    <div class="delivery-form-block">
                        <div class="delivery_edit">
                            <input type="date" name="delivery_from_date[]" value="{{ \Carbon\Carbon::parse($time->delivery_from)->format('Y-m-d') }}">
                            <input type="time" name="delivery_from_time[]" value="{{ \Carbon\Carbon::parse($time->delivery_from)->format('H:i') }}">
                        </div>    

                        <div class="text"> 
                            <p>～</P>
                        </div>    

                        <div class="delivery_edit">
                            <input type="date" name="delivery_to_date[]" value="{{ \Carbon\Carbon::parse($time->delivery_to)->format('Y-m-d') }}">
                            <input type="time" name="delivery_to_time[]" value="{{ \Carbon\Carbon::parse($time->delivery_to)->format('H:i') }}">
                        </div>   
                        <button type="button" class="remove-date">-</button>
                    </div>
                     @endforeach
                </div>

                <div class="delivery-button">
                    <button type="button" class="add-date">＋</button>
                    <button type="submit" class="register">登録</button>
                </div>
            </form>

            <script>
                document.querySelector('.add-date').addEventListener('click', function() {
                    let container = document.getElementById('delivery-container');
                    let newBlock = document.createElement('div');
                    newBlock.className = 'delivery-form-block';

                    newBlock.innerHTML = `
                        <div class="delivery_edit">
                        <input type="date" name="delivery_from_date[]">
                        <input type="time" name="delivery_from_time[]">
                        </div>    

                        <div class="text"> 
                        <p>～</p>
                        </div>    

                        <div class="delivery_edit">
                        <input type="date" name="delivery_to_date[]">
                        <input type="time" name="delivery_to_time[]">
                        </div>   
                        <button type="button" class="remove-date">-</button>
                    `;

                        container.appendChild(newBlock);
                    });

                    document.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('remove-date')) {
                        e.target.closest('.delivery-form-block').remove();
                        }
                    });
            </script>

            @endsection
    </body>
</html>
