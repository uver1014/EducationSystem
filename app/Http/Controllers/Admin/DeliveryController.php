<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller{

    public function showDeliveryEdit($id){
        $curriculum = Curriculum::with('deliveryTimes')->findOrFail($id);

        if ($curriculum->alway_delivery_flg == 0) {
            $deliverytimes = $curriculum->deliveryTimes;
        } else {
            $deliverytimes = collect();
        }

        $title = $curriculum->title;

        return view('admin.delivery', [
            'curriculum' => $curriculum,
            'deliverytimes' => $deliverytimes,
            'title' => $title,
            'curriculum_id' => $curriculum->id,
        ]);
    }
    
    public function update(Request $request, $id) {
        $curriculum = Curriculum::findOrFail($id);
        $fromDate = $request->delivery_from_date;
        $fromTime = $request->delivery_from_time;
        $toDate   = $request->delivery_to_date;
        $toTime   = $request->delivery_to_time;

        if (!is_array($fromDate) || !is_array($fromTime) || !is_array($toDate) || !is_array($toTime)) {
            return back()->withErrors(['message' => '配信日時の形式が正しくありません。']);
        }

        try {
            DB::transaction(function () use ($curriculum, $fromDate, $fromTime, $toDate, $toTime) {
                $curriculum->deliveryTimes()->delete();

        for ($i = 0; $i < count($fromDate); $i++) {
            $delivery = new DeliveryTime();
            $delivery->curriculums_id = $curriculum->id;
            $delivery->delivery_from = Carbon::createFromFormat('Y-m-d H:i', $fromDate[$i] . ' ' . $fromTime[$i]);
            $delivery->delivery_to   = Carbon::createFromFormat('Y-m-d H:i', $toDate[$i] . ' ' . $toTime[$i]);
            $delivery->save();
        }
       
        $curriculum->alway_delivery_flg = 0;
        $curriculum->save();
    });
    
        return redirect()->back()->with('success', '配信時間を更新しました');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => '更新中にエラーが発生しました: ' . $e->getMessage()]);
        }
    }
}