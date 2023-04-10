<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use App\Http\Requests\StorePangkatRequest;
use App\Http\Requests\UpdatePangkatRequest;

class PangkatController extends Controller
{
    public function index()
    {
        return view('Admin.Pangkat.index',[
            'pangkat'=>Pangkat::latest()->paginate(7),
            'active'=>'Pangkat',
            'title'=>'Pangkat',
        ]);
    }

    public function create()
    {

    }

    public function store(StorePangkatRequest $request)
    {
        $pesan=[
            'required'=> ':attribute Wajib diisi !',
            'min'=> ':attribute Harus diisi min :min karakter !',
            'max'=> ':attribute Harus diisi max :max karakter !',
        ];
        $validate=$request->validate([
            "kode"=> 'required|min:2|max:5',
            'nama'=>'required'
        ],$pesan);

        $nama=Pangkat::where('kode','=',$validate['kode'])->get();

        if($nama==true){
            return redirect('/admin/pangkat')->with('failed', 'Kode '.$validate['kode'].' Sudah ada');
        }

        if($nama==false){
            Pangkat::create($validate);
            return redirect('/admin/pangkat')->with('add','Entry Data '.$validate['nama'].' Success');
        }
        else {
            return redirect('/admin/pangkat');
        }
    }

    public function show(Pangkat $pangkat)
    {
        //
    }

    public function edit(Pangkat $pangkat)
    {

    }

    public function update(UpdatePangkatRequest $request, $id)
    {
        $pesan = [
            'required' => ':attribute Wajib diisi !',
            'min' => ':attribute Harus diisi min :min karakter !',
            'max' => ':attribute Harus diisi max :max karakter !',
        ];

        $update = $request->validate([
            'kode'=> 'required|min:2|max:5',
            'nama'=>'required',
        ],$pesan);

        $samaKode = Pangkat::where('kode', '=', $update['kode'])->get('kode');
        $bedaKode = Pangkat::where('kode', '!=', $update['kode'])->get('kode');

        if($samaKode==true){
            if($bedaKode==true){
                Pangkat::where('id', $id)->update($update);
                return redirect('/admin/pangkat')->with('edit', 'Update Data ' . $update['nama'] . ' Success');
              }
              return redirect('/admin/pangkat')->with('failed', 'Kode ' . $update['kode'] . ' Sudah ada ');
        }

        elseif ($samaKode==false) {
            Pangkat::where('id', $id)->update($update);
            return redirect('/admin/pangkat')->with('edit', 'Update Data ' . $update['nama'] . ' Success');
        }

    }

    public function destroy($id)
    {
        Pangkat::destroy($id);
        return redirect('/admin/pangkat')->with('delete', 'Delete Data Success');
    }
}
