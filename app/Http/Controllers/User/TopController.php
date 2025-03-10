<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Article;

class TopController extends Controller
{
    public function index()
    {
        $banners = Banner::select('image')->get();
        $articles = Article::select('title', 'posted_date', 'article_contents') // ← 追加
            ->orderBy('posted_date', 'desc')
            ->limit(5)
            ->get();

        return view('user.top', compact('banners', 'articles'));
    }

}

