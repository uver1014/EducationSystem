<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use Carbon\Carbon;

class CurriculumController extends Controller
{
    public function showCurriculumList(Request $request)
    {
        try {
            //現在の月を取得（デフォルトは現在）
            $currentMonth = $request->input('month',Carbon::now()->format('Y-m'));

            // ログインユーザーの学年ID
            $currentUserGradeId = Auth::user()->grade_id ?? 1;

            //ユーザーのデフォルト学年（ログイン中のユーザーの学年）
            $currentGradeId = $request->input('grade',Auth::user()->grade_id ?? 1);

            //配信機関と学年でカリキュラムを取得
            $curriculums = Curriculum::with('grade', 'deliveryTimes')
                ->where('grade_id', $currentGradeId)
                ->where(function ($query) use ($currentMonth) {
                // 常時公開のカリキュラム
                $query->where('alway_delivery_flg', 1)
                // または、指定された配信月のカリキュラム
                    ->orWhereHas('deliveryTimes', function ($q) use ($currentMonth) {
                    $q->whereMonth('delivery_from', Carbon::parse($currentMonth)->month)
                    ->whereYear('delivery_from', Carbon::parse($currentMonth)->year);
                });
            })
            ->get();
            return view('user.curriculum_list',compact('curriculums','currentMonth','currentGradeId','currentUserGradeId'));

        } catch (\Exception $e) {
            \Log::error('カリキュラム表示中にエラー: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'カリキュラムの表示中にエラーが発生しました。');
        }
    }

    //学年変更時のカリキュラム表示
    public function changeGrade(Request $request,$grade)
    {
        return redirect()->route('user.show.curriculum',[
            'month' => $request->query('month',Carbon::now()->format('Y-m')),
            'grade' => $grade
        ]);
    }

     public function changeMonth(Request $request, $direction)
     {
         $currentMonth = Carbon::parse($request->query('month', Carbon::now()->format('Y-m')));
         $newMonth = ($direction === 'prev') ? $currentMonth->subMonth() : $currentMonth->addMonth();
         $currentGradeId = $request->query('grade', Auth::user()->grade_id ?? 1); // 現在の学年を取得
 
         return redirect()->route('user.show.curriculum', [
             'month' => $newMonth->format('Y-m'),
             'grade' => $currentGradeId, // 現在の学年を維持
         ]);
    }
}