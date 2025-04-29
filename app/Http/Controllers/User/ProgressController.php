<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function showProgress()
    {
        return view('user.curriculum_progress');
    }
}