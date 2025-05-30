<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function showLoginForm(){
       return view('admin.login');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('show.login');
    }
}
