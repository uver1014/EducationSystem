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

        // アップロードされた画像のオリジナルファイルを取得
        $originalName = $request->file('image')->getClientOriginalName();

        //　画像を保存するディレクトリ
        $path = $request->file('image')->storeAs('public/images/banner',$originalName);

        //　データベースに保存
        Banner::create([
            'image' => 'storage/images/banner/' . $originalName]);

        return redirect()->back()->with('success', 'バナーを追加しました。');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        //　ファイルを削除
        Storage::delete(str_replace('storage/', 'public/', $banner->image));
        //　データベースから削除
        $banner->delete();

        return redirect()->back()->with('success', 'バナーを削除しました。');
        
    }
}