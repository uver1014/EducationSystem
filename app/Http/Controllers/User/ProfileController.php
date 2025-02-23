<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function showProfileForm()
    {

        $auth = Auth::user();

        return view('user.profile_edit', ['auth' => $auth]);
    }

    public function profileUpdate(UserRequest $request) {


    }
}
