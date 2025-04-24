<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;

class BannerController extends Controller
{
    public function showBannerEdit()
    {
        $banners = Banner::all();
        return view('admin.banner_edit',compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/images/banner', $filename);

        Banner::create([
            'image' => 'storage/images/banner/' . $filename,
        ]);

        return redirect()->route('admin.show.banner.edit')->with('success', 'バナーを追加しました。');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        Storage::delete(str_replace('storage/', 'public/', $banner->image));
        $banner->delete();

        return redirect()->route('admin.show.banner.edit')->with('success', 'バナーを削除しました。');
        
    }
}