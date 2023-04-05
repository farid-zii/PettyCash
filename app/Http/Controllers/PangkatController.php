<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use App\Http\Requests\StorePangkatRequest;
use App\Http\Requests\UpdatePangkatRequest;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Pangkat.index',[
            'pangkat'=>Pangkat::latest()->paginate(7),
            'active'=>'Pangkat',
            'title'=>'Pangkat',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePangkatRequest  $request
     * @return \Illuminate\Http\Response
     */
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

        $nama=Pangkat::where('kode','=',$validate['kode'])->get('kode');

        if($nama==true){
            return redirect('/admin/pangkat')->with('failed', 'Kode '.$validate['kode'].' Sudah ada');
        }

        if(Pangkat::create($validate)==true){
            return redirect('/admin/pangkat')->with('add','Entry Data Success');
        }
        else {
            return redirect('/admin/pangkat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function show(Pangkat $pangkat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(Pangkat $pangkat)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePangkatRequest  $request
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
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

        $nama = Pangkat::where('kode', '!=', $update['kode'])->get();
        $sama = Pangkat::where('kode', '=', $update['kode'])->get('kode');

        // $samaId = Pangkat::where('id','=', $id)->get();
        $samaId = Pangkat::where('id','=', $id)->get('kode');
        $sama3= $samaId==$sama;
        //jika id sama -> kode tidak sama dengan
        if($samaId==$sama){
                Pangkat::where('id', $id)->update($update);
                return redirect('/admin/pangkat')->with('edit', 'Update Data ' . $update['nama'] . ' Success');
            // }
            // return redirect('/admin/pangkat')->with('failed', 'Kode ' . $sama . ' Sudah ada ');
        }
        // if($sama==false){
        //     return redirect('/admin/pangkat')->with('failed', 'Kode ' . $sama . ' Sudah ada ');
        // }
        elseif ($nama==true) {
            Pangkat::where('id', $id)->update($update);
            return redirect('/admin/pangkat')->with('edit', 'Update Data ' . $update['nama'] . ' Success');
        }
        else{
        return redirect('/admin/pangkat')->with('failed','Kode '.$sama.' Sudah ada ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pangkat  $pangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pangkat::destroy($id);
        return redirect('/admin/pangkat')->with('delete', 'Delete Data Success');
    }
}
