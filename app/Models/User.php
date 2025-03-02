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

    protected $table = 'users';    
    
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

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

    public function updatePassword($currentPassword, $newPassword)
    {
        
        $user = User::find($this->id);

        // 現在のパスワードが一致するか確認
        if (!Hash::check($currentPassword, $user->password)) {
            return false; // パスワードが一致しない場合
        }

        // 新しいパスワードをハッシュ化
        $newPasswordHashed = Hash::make($newPassword);

        try {
    
            DB::beginTransaction();

            $user->update(['password' => $newPasswordHashed]);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
