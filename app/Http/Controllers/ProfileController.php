<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function admin(){
        return view('admin.profile.index',[
            'active'=>'Profile'
        ]);
    }
    public function finance(){
        return view('finance.profile.index');
    }
    public function direktur(){
        return view('direktur.profile.index');
    }
}
