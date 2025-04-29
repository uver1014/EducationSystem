@extends('admin.layouts.app')

@section('content')
    <a href="{{ route('admin.top')}}" style="text-decoration:none; color:black; font-size:1rem;">←戻る</a>
    <div class="container">
        <h1>バナー管理</h1>
        <form action="{{ route('admin.banner.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div id="banner-container">
                @foreach ($banners as $banner)
                    <div class="banner-item" style="display: flex;">
                        <div>
                        @if ($banner->image)
                            <img src="{{ asset($banner->image) }}" alt="バナー画像" class="banner-image" style="width: 100px">
                            <input type="hidden" name="old_images[]" value="{{ $banner->image }}">
                        @else    
                            <p>画像が登録されていません</p>
                        @endif
                    </div>
                    <div>
                        <input type="file" name="images[]">
                        <button type="button" class="delete-button" onclick="removeBanner(this,{{ $banner->id }})">ー</button>
                        <input type="hidden" name="delete_ids[]" value="" class="delete-input">
                    </div>
                    </div>
                @endforeach

                <div id="new-banner-template" class="banner-item hidden">
                    <div>
                        <input type="file" name="images[]">
                        <button type="button" class="delete-button" onclick="removeBanner(this)">ー</button>   
                    </div>                 </div>
                </div>
            </div>
            <div>
            <button type="button" id="add-banner" class="add-button">＋</button>
            </div>
            <div>
            <button type="submit" class="btn btn-secondary">登録</button>
            </div>
        </form>

        <script>
            document.getElementById('add-banner').addEventListener('click',function(){
                const container = document.getElementById('banner-container');
                const template = document.getElementById('new-banner-template').cloneNode(true);
                template.classList.remove('hidden');
                container.appendChild(template);
            });

            function removeBanner(element,id) {
                if (confirm('このバナーを削除しますか？')) {
                    const bannerItem = element.parentNode.parentNode;
                    const deleteInput = bannerItem.querySelector('.delete-input');
                    deleteInput.value = id;
                    bannerItem.style.display = 'none';
                }
            }
            
            function removeNewBanner(element) {
                const bannerItem = element.parentNode.parentNode;
                bannerItem.remove();
            }
        </script>
    </div>
@endsection 