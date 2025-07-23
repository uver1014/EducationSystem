<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCurriculumRequest;
use Illuminate\Support\Facades\DB;


class CurriculumController extends Controller{
    public function showCurriculumList(){
        $grades = Grade::all();
        $curriculums = Curriculum::with('deliveryTimes')->get();
        return view('admin.curriculum_list', compact('curriculums', 'grades'));
    }

    public function getGradeCurriculums($id){
        $grade = Grade::findOrFail($id);
        $curriculums = $grade->curriculums()->with('deliveryTimes')->get(); 
        return response()->json($curriculums);
    }

    public function createCurriculum(){
        $curriculum = new Curriculum();
        $grades = Grade::all(); 
        $curriculum->deliveryTimes = collect();
        return view('admin.curriculum_edit', compact('curriculum', 'grades'));
    }

    public function showCurriculumEdit($id){
        $grades = Grade::all(); 
        $curriculum = Curriculum::with('deliveryTimes')->findOrFail($id);
        return view('admin.curriculum_edit', compact('curriculum', 'grades'));
    }

    public function store(StoreCurriculumRequest $request){
        DB::transaction(function () use ($request) {
            $curriculum = new Curriculum;
            $curriculum->saveCurriculumData($request)->save();
         });

        return redirect()->route('admin.show.curriculum.create')->with('success', '登録が完了しました');
    }

    public function update(StoreCurriculumRequest $request, $id){
        $response = DB::transaction(function () use ($request, $id) {
            $curriculum = Curriculum::findOrFail($id);
            $curriculum->saveCurriculumData($request)->save();

            return response()->json([
                'message' => '更新しました',
                'grade_id' => $curriculum->grade_id,
                ], 200, [], JSON_UNESCAPED_UNICODE);
            });

        return $response;
    }
}