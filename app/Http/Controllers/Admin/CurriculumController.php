<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;

class CurriculumController extends Controller{
    public function showCurriculumList(){
        $curriculums = Curriculum::with('deliveryTimes')->get();
        return view('admin.curriculum_list', compact('curriculums'));
    }

    public function gradeCurriculums($id){
        $grade = Grade::findOrFail($id);
        $curriculums = $grade->curriculums()->with('deliveryTimes')->get(); 
        return response()->json($curriculums);
    }

    public function createCurriculum(){
        $curriculum = new Curriculum();
        $curriculum->deliveryTimes = collect();
        return view('admin.curriculum_edit', compact('curriculum'));
    }

    public function showCurriculumEdit($id){
        $curriculum = Curriculum::with('deliveryTimes')->findOrFail($id);
        return view('admin.curriculum_edit', compact('curriculum'));
    }

    public function store(Request $request){
        $request->validate([
            'thumbnail' => 'string',
            'grade' => 'required|integer',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'required|string',
            'alway_delivery_flg' => 'nullable|boolean',
            ], [
            'grade.required' => '学年は必須です',
            'title.required' => '授業名は必須です',
            'video_url.required' => '動画URLは必須です',
            'description.required' => '授業概要は必須です',
            'thumbnail.string' => 'サムネイルの値が不正です',
            'grade.integer' => '学年は数字で指定してください',
            'title.string' => '授業名は文字列で入力してください',
            'title.max' => '授業名は255文字以内で入力してください',
            'video_url.url' => '動画URLは有効なURLを入力してください',
            'description.string' => '授業概要は文字列で入力してください',
            'alway_delivery_flg.boolean' => '常時公開フラグの値が不正です',
        ]);

        $curriculum = new Curriculum;
        $curriculum->thumbnail = $request->input('thumbnail');
        $curriculum->grade_id = $request->input('grade');
        $curriculum->title = $request->input('title');
        $curriculum->video_url = $request->input('video_url');
        $curriculum->description = $request->input('description');
        $curriculum->alway_delivery_flg = $request->has('alway_delivery_flg') ? 1 : 0;

        $curriculum->save();
        return redirect()->route('admin.show.curriculum.create')->with('success', '登録が完了しました');
    }

    public function update(Request $request, $id){
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->thumbnail = $request->input('thumbnail');
        $curriculum->grade_id = $request->input('grade');
        $curriculum->title = $request->input('title');
        $curriculum->video_url = $request->input('video_url');
        $curriculum->description = $request->input('description');
        $curriculum->alway_delivery_flg = $request->input('alway_delivery_flg') ? 1 : 0;

        $curriculum->save();

        return response()->json([
            'message' => '更新しました',
            'grade_id' => $curriculum->grade_id,
            ], 200, [], JSON_UNESCAPED_UNICODE);
    }

}