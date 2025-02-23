<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //お知らせ画面を表示
    public function showArticle($id)
    {
        $article = Article::find($id);

        return view('user.article', ['article' => $article]);
    }
}
