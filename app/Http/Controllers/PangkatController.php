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
        $validete=$request->validate([
            "kode"=> 'required|min:2|max:5',
            'nama'=>'required'
        ],$pesan);

        if(Pangkat::create($validete)==true){
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
        $update = $request->validate([
            'kode'=> 'required|min:2|max:5',
            'nama'=>'required',
        ]);

        Pangkat::where('id',$id)->update($update);
        return redirect('/admin/pangkat')->with('edit','Update Data Success');
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
