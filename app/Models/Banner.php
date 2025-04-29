<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';
    protected $fillable = ['image'];

    public function deleteImage()
    {
        if ($this->image && Storage::exists('public/'.$this->image)) {
            Storage::delete('public/'.$this->image);
        }
        // $this->image =null;
        $this->save();
    }
}