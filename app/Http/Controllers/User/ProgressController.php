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
  
        $curriculums = Curriculum::getInfo($user);
    
        return view('user.curriculum_progress', ['user' => $user, 'grades'=> $grades, 'curriculums' => $curriculums]);
    }
}
