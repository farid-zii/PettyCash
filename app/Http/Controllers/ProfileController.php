<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

            $model = User::find($r->id)->first();

            if($r->gambar!=null){
                // dd($r->gambar);
                Storage::delete($model->foto);

                $namaFoto= time() . '_' . $r->nama.'.jpg';
                $r->gambar->move(public_path('Storage/foto_profile'), $namaFoto);
                $a=User::where('id','=',$r->id)->update([
                    'nama'=>$r->nama,
                    'username'=>$r->username,
                    'foto'=>$namaFoto,
                    'nip'=>$r->nip,
                    'email'=>$r->email,
                    'phone'=>$r->phone,
                    'password'=>bcrypt($r->password),
                ]);
                return back()->with('success', 'Profile berhasil di edit');
            }
            $a=User::where('id','=',$r->id)->update([
                'nama' => $r->nama,
                'username' => $r->username,
                'nip' => $r->nip,
                'email' => $r->email,
                'phone' => $r->phone,
                'password' => bcrypt($r->password),
            ]);

            return back()->with('success','Profile berhasil di edit');
        }
        return back()->with('failed','Password berbeda');

    }
}
