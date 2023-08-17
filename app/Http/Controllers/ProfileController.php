<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function admin(){
        return view('admin.profile.index',[
            'active'=>'Profile'
        ]);
    }
    public function finance(){
        return view('finance.profile.index',[
            'active' => 'Profile'
        ]);
    }
    public function pimpinan(){
        return view('pimpinan.profile.index',[
            'active' => 'Profile'
        ]);
    }
    public function pegawai(){
        return view('pegawai.profile.index',[
            'active' => 'Profile'
        ]);
    }

    public function update(Request $r){
        if($r->password == $r->password2){
            $a=User::where('id','=',$r->id)->update([
                'nama'=>$r->nama,
                'nip'=>$r->nip,
                'email'=>$r->email,
                'phone'=>$r->phone,
                'password'=>bcrypt($r->password),
            ]);
            dd($a);
            return back()->with('success','Profile berhasil di edit');
        }
        return back()->with('failed','Password berberda');

    }
}
