<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function show($id)
    {
        try {
            // 授業情報の取得（モデルメソッドを使用）
            $lesson = Curriculum::getLessonWithGrade($id);

            // 配信可能かチェック（モデルメソッドを使用）
            $isAvailable = $lesson->isAvailable();

            return view('delivery.show', compact('lesson', 'isAvailable'));

        } catch (\Exception $e) {
            return abort(404, '授業情報が見つかりません');
        }
    }

    public function complete($id)
    {
        try {
            // 授業情報が存在するかチェック（エラーハンドリング）
            Curriculum::getLessonWithGrade($id);

            // 受講完了の処理（モデルメソッドを使用）
            CurriculumProgress::completeLesson($id);

            return response()->json(['message' => '受講完了']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'エラーが発生しました: ' . $e->getMessage()], 500);
        }
    }
}
