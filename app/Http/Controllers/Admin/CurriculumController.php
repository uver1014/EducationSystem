<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CurriculumController extends Controller
{
    public function showCurriculumList()
    {
        return view('admin.curriculum_list');
    }
}