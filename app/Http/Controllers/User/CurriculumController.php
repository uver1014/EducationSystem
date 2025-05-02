<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use Carbon\Carbon;

class CurriculumController extends Controller
{
    public function showCurriculumList(Request $request)
    {
        //現在の月を取得（デフォルトは現在）
        $currentMonth = $request->input('month',Carbon::now()->format('Y-m'));

        //ユーザーのデフォルト学年（ログイン中のユーザーの学年）
        $currentGradeId = $request->input('grade',Auth::user()->grade_id ?? 1);

        //配信機関と学年でカリキュラムを取得
        $Curriculums = Curriculum::available();
        $curriculums = Curriculum::with('grade')
            ->where('grade_id',$currentGradeId)
            ->whereHas('deliveryTimes',function ($query) use ($currentMonth) {
                $query->whereMonth('delivery_from',Carbon::parse($currentMonth)->month)
                      ->whereYear('delivery_from',Carbon::parse($currentMonth)->year);
            })
            ->get();


        return view('user.curriculum_list',compact('curriculums','currentMonth','currentGradeId'));
    }

    //学年変更時のカリキュラム表示
    public function changeGrade(Request $request,$grade)
    {
        return redirect()->route('user.show.curriculum',[
            'month' => $request->query('month',Carbon::now()->format('Y-m')),
            'grade' => $grade
        ]);
    }

    //前月・翌月のカリキュラム表示
    public function changeMonth(Request $request,$direction)
    {
        $currentMonth = Carbon::parse($request->query('month',Carbon::now()->format('Y-m')));
        $newMonth = ($direction === 'prev') ? $currentMonth->subMonth() : $currentMonth->addMonth();

        return redirect()->route('user.show.curriculum',[
            'month' => $newMonth->format('Y-m'),
            'grade' => $request->query('grade',Auth::user()->grade_id ?? 1)
        ]);
    }
}