<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable =[ 'name' ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function curriculum() {
        
        return $this->hasMany(Curriculum::class);
        
    }
}
