<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\View\View;

class DeliveryController extends Controller
{
    /**
     * カリキュラムの配信ページを表示する。
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\View\View
     */
    public function showDelivery(Curriculum $curriculum): View
    {
        // $curriculum モデルは、ルートパラメータに基づいて自動的に解決されます。
        // 必要に応じて、追加のデータを取得したり、ロジックを実行したりできます。

        return view('user.delivery', compact('curriculum'));
    }
}