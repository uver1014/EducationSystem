<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use GuzzleHttp\Psr7\Message;

class ProfileController extends Controller
{
    public function showProfileForm()
    {
        $model = new User();
        $user = $model->getUser();

        if (!$user) {
            return redirect()->route('user.show.login')->with('error', 'ログインしてください');
        }

        return view('user.profile_edit', ['user' => $user]);
    }

    public function profileUpdate(UserRequest $request)
    {

        $model = new user();
        $auth = $model->getUser();
        $image_path = null; // 初期化

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $path = $auth->profile_image;

            if (isset($image)) {
                //古い画像を削除
                Storage::delete('public/images/profile/' . $path);
                //新しい画像を保存
                $fileName = $image->getClientOriginalName();
                $image->storeAs('public/images/profile', $fileName);
                $image_path = 'storage/images/profile/' . $fileName;
            }
        }
        DB::beginTransaction();
        try {
            $user = $model->exeUpdate($request, $image_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message', '更新に失敗しました。');
        }
        

        return redirect(route('user.show.profile'))->with('message', '更新しました');
    }

    public function showPasswordFrom()
    {
        return view('user.password_edit');
    }

    public function passwordUpdate(Request $request){
       
            // バリデーション
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);
    
            // ログインしているユーザーを取得
            $user = Auth::user();
    
            // モデルメソッドを使ってパスワード更新処理
            $isUpdated = $user->updatePassword($request->current_password, $request->new_password);
    
            // 結果に応じてリダイレクト
            if ($isUpdated) {
                return redirect()->route('user.show.profile')->with('message', 'パスワードが更新されました');
            } else {
                return back()->with(['message', 'current_password' => '現在のパスワードが間違っています']);
            }
        }
}
