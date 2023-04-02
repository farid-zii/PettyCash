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
            'pangkat'=>Pangkat::latest()->get(),
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
        $validete=$request->validate([
            "kode"=>'required',
            'nama'=>'required'
        ]);

        Pangkat::create($validete);
        return redirect('/admin/pangkat')->with('add','Create Data Success');
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
            'kode'=>'required',
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
        return redirect('/admin/pangkat')->with('pesan', 'Data Berhasil Dihapus');
    }
}
