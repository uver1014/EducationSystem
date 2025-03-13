<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255|regex:/^[ァ-ヶーｱ-ﾝﾞﾟ]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name_kana.regex' => 'カナは全角または半角カタカナで入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
        ]);

        // 🔹 モデルの `createUser()` を使用してユーザー作成
        $user = User::createUser($request->all());

        // 登録後に自動ログイン
        Auth::login($user);

        return redirect()->route('user.show.top')->with('success', '登録が完了しました！');
    }
}
