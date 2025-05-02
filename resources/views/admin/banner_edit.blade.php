@extends('admin.layouts.app')

@section('content')
    <a href="{{ route('admin.top')}}" style="text-decoration:none; color:black; font-size:1rem;">←戻る</a>
    <div class="container">
        <h1>バナー管理</h1>
        <form action="{{ route('admin.banner.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div id="banner-container" style="text-align:center">
                @foreach ($banners as $banner)
                    <div class="banner-item" style="padding:10px;display:flex;justify-content:center;align-items:center">
                        <div>
                        @if ($banner->image)
                            <img src="{{ asset($banner->image) }}" alt="バナー画像" class="banner-image" style="max-width:200px;max-height:200px;margin-right:10px">
                            <input type="hidden" name="old_images[]" value="{{ $banner->image }}">
                        @else    
                            <p>画像が登録されていません</p>
                        @endif
                    </div>
                    <div>
                        <input type="file" name="images[]">
                        <button type="button" class="btn rounded-circle btn-danger" onclick="removeBanner(this,{{ $banner->id }})">ー</button>
                        <input type="hidden" name="delete_ids[]" value="" class="deleted-input">
                    </div>
                    </div>
                @endforeach

                <div id="new-banner-template" class="banner-item hidden">
                    <div>
                        <input type="file" name="images[]">
                        <button type="button" class="btn rounded-circle btn-danger" onclick="removeNewBanner(this)">ー</button>   
                    </div>
                    <input type="hidden" name="delete_ids[]" value="" class="deleted-input">
                </div>
            </div>
            <div style="padding-left: 20%">
            <button type="button" id="add-banner" class="btn rounded-circle btn-success">＋</button>
            </div>
            <div style="display:flex;justify-content:center">
            <button type="submit" class="btn btn-secondary">登録</button>
            </div>
        </form>
        <script>
            function removeBanner(element, id) {
                if (confirm('このバナーを削除しますか？')) {
                    const bannerItem = element.parentNode.parentNode;
                    const deleteInput = bannerItem.querySelector('.deleted-input');
                    deleteInput.value = id;
                    bannerItem.style.display = 'none';
                }
            }

            function removeNewBanner(element) {
                const bannerItem = element.parentNode.parentNode;
                bannerItem.remove();
            }

            document.addEventListener('DOMContentLoaded', function() {
                const newBannerTemplate = document.getElementById('new-banner-template');
                if (newBannerTemplate) {
                    newBannerTemplate.style.display = 'none';
                }

                document.getElementById('add-banner').addEventListener('click', function() {
                    const container = document.getElementById('banner-container');
                    const template = document.getElementById('new-banner-template').cloneNode(true);
                    template.classList.remove('hidden');
                    template.classList.add('banner-item');
                    template.style.display = 'flex';
                    template.style.paddingTop = '10px';
                    template.style.justifyContent = 'center';
                    template.style.alignItems = 'center'; 
                    container.appendChild(template);
                });
            });
        </script>

    </div>
@endsection 