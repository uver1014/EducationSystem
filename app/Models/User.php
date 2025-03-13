<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens; // 🔥 これを追加

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'name_kana', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    /**
     * ユーザー登録処理
     *
     * @param array $data
     * @return \App\Models\User
     */
    public static function createUser(array $data)
    {
        return self::create([
            'name' => $data['name'],
            'name_kana' => $data['name_kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
