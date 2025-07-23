<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateDeliveryRequest;

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
    
    public function update(UpdateDeliveryRequest $request, $id){
        $curriculum = Curriculum::findOrFail($id);
        $fromDate = $request->delivery_from_date ?? [];
        $fromTime = $request->delivery_from_time ?? [];
        $toDate   = $request->delivery_to_date ?? [];
        $toTime   = $request->delivery_to_time ?? [];

        try {
            DB::transaction(function () use ($curriculum, $fromDate, $fromTime, $toDate, $toTime) {
                $curriculum->saveDeliveryTimes($fromDate, $fromTime, $toDate, $toTime);

            });
    
        return redirect()->back()->with('success', '配信時間を更新しました');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => '更新中にエラーが発生しました: ' . $e->getMessage()]);
        }
    }
}