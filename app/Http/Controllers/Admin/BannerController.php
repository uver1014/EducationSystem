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
    public function update(Request $request)
    {
        $request->validate([
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'old_images.*' => 'nullable|string',
            'delete_ids.*' => 'nullable|integer',
        ]);

        //削除されたバナーを処理
        if ($request->has('delete_ids')) {
            foreach ($request->input('delete_ids') as $id){
                $banner = Banner::find($id);
                if ($banner) {
                    $banner->deleteImage();
                    $banner->delete();
                }
            }
        }

        //新しいバナー画像を処理
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('public/images/banner',$filename);
                Banner::create(['image' => str_replace('public/','storage/',$path)]);
            }
        }

        return redirect()->route('admin.show.banner.edit')->with('success','バナー画像を更新しました。');
        
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