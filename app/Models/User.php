<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'password',
        'grade_id',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUser(){

        return  DB::table('users')
        ->join('grades', 'users.grade_id', '=', 'grades.id')
        ->where('users.id', Auth::id())
        ->select('users.*', 'grades.name')
        ->first();
    }

    public function exeUpdate($data, $image_path){

        return DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'name' => $data->name,
                'name_kana' => $data->name_kana,
                'email' => $data->email,
                'profile_image' => $image_path,
            ]);

    }

    public function updatePassword($currentPassword, $newPassword)
    {
        // クエリビルダを使用して現在のパスワードを確認
        $user = DB::table('users')->where('id', $this->id)->first();

        // 現在のパスワードが一致するか確認
        if (!Hash::check($currentPassword, $user->password)) {
            return false; // パスワードが一致しない場合
        }

        // 新しいパスワードをハッシュ化
        $newPasswordHashed = Hash::make($newPassword);

        try {
            // トランザクションを開始
            DB::beginTransaction();

            // 新しいパスワードを更新
            DB::table('users')
                ->where('id', $this->id)
                ->update(['password' => $newPasswordHashed]);

            // コミット
            DB::commit();
            return true;

        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollBack();
            return false;
        }
    }
}
