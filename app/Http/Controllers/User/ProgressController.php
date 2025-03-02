<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\CurriculumProgress;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;

class ProgressController extends Controller
{
    public function showProgress($id = null) {

        $user = User::find(1);

        $grades = Grade::all();

        if (!$id){
            $curriculums =Curriculum::all();
        } else{
            $curriculums = Curriculum::where('grade_id' , $id)->get();
        }

        $curriculum_progress = CurriculumProgress::where('users_id', $user->id)->get()->keyBy('curriculum_id');
    
        return view('user.curriculum_progress', ['grades'=> $grades, 'curriculums' => $curriculums,'curriculum_progress' => $curriculum_progress,],compact('user'));
    }
}
