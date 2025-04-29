<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/top'; //登録後のリダイレクト先

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin'); //管理者専用のゲストミドルウェア
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register'); //管理者用登録ビューを返す
        
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'kana' => 'required|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'email' => 'required|email',
            'password' => 'required|min:8|',
            'password_confirmation' => 'required|min:8|same:password', 
        ],[
                        //カスタムメッセージ
            'name.required' => 'ユーザーネームを入力してください。',
            
            'kana.required' => 'カナを入力してください。',
            'kana.required' => 'カタカナで入力してください。',

            'email.required' => 'メールアドレスを入力してください。',
            'email.email' =>'＠を含むメール形式で入力してください。',

            'password.required' => 'パスワードを入力してください。',
            'password.min' => '８文字以上で入力してください。',

            'password_confirmation.required' => 'パスワードを入力してください。',
            'password_confirmation.min' => '８文字以上で入力してください。',
            'password_confirmation.same' => '上記パスワードと一致していません。',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'kana' => $data['kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),// パスワードをハッシュ化
        ]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'kana' => 'required|regex:/^[ァ-ケー]+$/u',
    //         'email' => 'required|email',
    //         'password' => 'required|min:8|confirmed', 
    //     ],[
    //         //カスタムメッセージ
    //         'name.required' => 'ユーザーネームを入力してください。',
            
    //         'kana.required' => 'カナを入力してください。',
    //         'kana.required' => 'カタカナで入力してください。',

    //         'email.required' => 'メールアドレスを入力してください。',
    //         'email.email' =>'＠を含むメール形式で入力してください。',

    //         'password.required' => 'パスワードを入力してください。',
    //         'password.min' => '８文字以上で入力してください。',
    //         'password.confirmed' => '上記パスワードと一致していません。',
    //     ]);
        
    // }

    public function guard()
    {
        return auth()->guard('admin'); //管理者専用のGuardを利用
        
    }
}
