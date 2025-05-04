@extends('admin.layouts.app')

@section('content')
    <a href="{{ route('admin.top')}}" class="ms-5 text-decoration-none text-dark fs-5">←戻る</a>
    <h1 class="ms-5 mt-2">バナー管理</h1>
    <div class="container">
        <form action="{{ route('admin.banner.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div id="banner-container" class="text-center">
                @foreach ($banners as $banner)
                    <div class="banner-item p-2 d-flex justify-content-center align-items-center">
                        <div>
                            @if ($banner->image)
                                <img src="{{ asset($banner->image) }}" alt="バナー画像" class="banner-image me-3" style="max-width:200px;max-height:200px;">
                                <input type="hidden" name="old_images[]" value="{{ $banner->image }}">
                            @else
                                <p>画像が登録されていません</p>
                            @endif
                        </div>
                        <div>
                            <input type="file" name="images[]" class="ms-3">
                            <button type="button" class="btn rounded-circle btn-danger fw-bold" onclick="removeBanner(this,{{ $banner->id }})">—</button>
                            <input type="hidden" name="delete_ids[]" value="" class="deleted-input">
                        </div>
                    </div>
                @endforeach

                <div id="new-banner-template" class="banner-item hidden">
                    <div>
                        <input type="file" name="images[]">
                        <button type="button" class="btn rounded-circle btn-danger fw-bold" onclick="removeNewBanner(this)">—</button>
                    </div>
                    <input type="hidden" name="delete_ids[]" value="" class="deleted-input">
                </div>
            </div>
            <div class="ps-5">
                <button type="button" id="add-banner" class="btn rounded-circle btn-success fw-bold">✚</button>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-secondary col-2 mx-auto">登録</button>
            </div>
        </form>
    </div>
    {{-- <script src="{{ asset('js/admin/banner_management.js') }}"></script> --}}
@endsection