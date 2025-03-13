<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'posted_date',
        'title',
        'article_contents',
    ];

    public function registArticle($data)
    {
    
        return DB::table('articles')->insert([
            'posted_date' => $data->input('posted_date'),
            'title' => $data->input('title'),
            'article_contents' => $data->input('article_contents'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateArticle($data, $id){

        return DB::table('articles')
        ->where('id', $id)
        ->update([
            'posted_date' => $data->input('posted_date'),
            'title' => $data->input('title'),
            'article_contents' => $data->input('article_contents'),
            'updated_at' => now(),
        ]);
    }
}
