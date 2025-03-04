<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use App\Models\DeliveryTime;

class LessonController extends Controller
{
    public function show($id)
    {
        $lesson = Curriculum::findOrFail($id);

        // 配信期間の確認
        $isAvailable = DeliveryTime::where('curriculums_id', $id)
            ->where('delivery_from', '<=', now())
            ->where('delivery_to', '>=', now())
            ->exists();

        return view('lesson.show', compact('lesson', 'isAvailable'));
    }

    public function complete(Request $request, $id)
    {
        $progress = CurriculumProgress::updateOrCreate(
            ['curriculums_id' => $id, 'users_id' => auth()->id()],
            ['clear_flg' => 1]
        );

        return response()->json(['message' => '受講済みにしました']);
    }
}
