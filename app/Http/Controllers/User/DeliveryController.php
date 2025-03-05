<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTime;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function show($id) {
        try {
            // 授業情報の取得
            $lesson = Curriculum::with('grade')->findOrFail($id);

            // 配信可能かチェック
            $isAvailable = DeliveryTime::where('curriculums_id', $id)
                ->where('delivery_from', '<=', now())
                ->where('delivery_to', '>=', now())
                ->exists();

            return view('delivery.show', compact('lesson', 'isAvailable'));

        } catch (\Exception $e) {
            return abort(404, '授業情報が見つかりません');
        }
    }

    public function complete($id) {
        try {
            // 授業情報の取得
            $lesson = Curriculum::findOrFail($id);

            // 受講完了の処理
            CurriculumProgress::updateOrCreate(
                ['users_id' => Auth::id(), 'curriculums_id' => $id],
                ['completed_at' => now(), 'clear_flg' => 1] 
            );

            return response()->json(['message' => '受講完了']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'エラーが発生しました: ' . $e->getMessage()], 500);
        }
    }
}
