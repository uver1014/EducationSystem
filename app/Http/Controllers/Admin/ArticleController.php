<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function showArticleList(){

        $articles = DB::table('articles')->get();

        return view('admin.article_list', ['articles' => $articles]);
    }

    public function showArticleCreate(){

        return view('admin.article_create');
    }

    public function ArticleCreate(ArticleRequest $request){

        DB::beginTransaction();

        try {
            $model = new Article();
            $article = $model->registArticle($request);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message', '登録に失敗しました。');
        }

        session()->flash('message', '登録しました');
        return redirect(route('admin.show.article.create'));

    }

    public function showArticleEdit($id){

        $article = Article::find($id);

        return view('admin.article_edit', ['article' => $article]);
    }

    public function ArticleEdit(ArticleRequest $request, $id){

        DB::beginTransaction();
        try {
            $model = new Article();
            $article = $model->updateArticle($request, $id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('message', '更新に失敗しました。');
        }

        return redirect(route('admin.show.article.edit', $id))->with('message', '更新しました');
    }

    public function ArticleDelete($id){

        try {
            //削除        
            Article::destroy($id);
        } catch (\Exception $e) {
            return back()->with('message', '削除に失敗しました。');
        }
        return redirect(route('admin.show.article.list'))->with('message', '削除しました');
    }
}
