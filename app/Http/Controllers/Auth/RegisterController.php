<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // 新規会員登録画面を表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // ユーザー登録処理
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', '登録が完了しました！');
    }
}
