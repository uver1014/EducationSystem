<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'posted_date', 'article_contents'];

    /**
     * 最新のお知らせを取得する
     *
     * @param int $limit 取得する記事の数
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getLatestArticles($limit = 5)
    {
        return self::select('title', 'posted_date', 'article_contents')
            ->orderBy('posted_date', 'desc')
            ->limit($limit)
            ->get();
    }
}
