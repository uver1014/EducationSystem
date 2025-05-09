<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use Illuminate\Support\Facades\Log;

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

        DB::beginTransaction();

        try {
            //削除処理
            if ($request->has('delete_ids')) {
                foreach ($request->input('delete_ids') as $id){
                    $banner = Banner::find($id);
                    if ($banner) {
                        $banner->deleteImage();
                        $banner->delete();
                    }
                }
            }

            //新規バナー処理
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('public/images/banner',$filename);
                    Banner::create(['image' => str_replace('public/','storage/',$path)]);
                }
            }

            DB::commit();

           return redirect()->route('admin.show.banner.edit')->with('success','バナー画像を更新しました。');

            
        } catch (\Throwable $th) {
            DB::rollBack();

            \Log::error('バナー更新エラー: ' . $e->getMessage());

            return redirect()->route('admin.show.banner.edit')
                            ->with('error', 'バナー画像の更新中にエラーが発生しました。');
        }

        
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $banner = Banner::findOrFail($id);
            //ファイルを削除
            Storage::delete(str_replace('storage/', 'public/', $banner->image));
            //データベースから削除
            $banner->delete();

            DB::commit();

            return redirect()->back()->with('success', 'バナーを削除しました。');
        
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('バナー削除中にエラーが発生しました: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString(),
            ]);
    
            return redirect()->back()->with('error', 'バナーの削除中にエラーが発生しました。');
        }       
    }
}