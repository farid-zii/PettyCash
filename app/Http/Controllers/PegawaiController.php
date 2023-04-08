<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\KategoriPgw;
use App\Models\Pangkat;
use App\Models\Saldo;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pegawai.index',[
            "pegawai"=>Pegawai::latest()->paginate(7),
            "kategori"=>KategoriPgw::get(),
            "jabatan"=>Jabatan::get(),
            "departemen"=>Departemen::get(),
            "pangkat"=>Pangkat::get(),
            'title'=>'Pegawai',
            "active"=>"pegawai"
        ]);
    }
    public function admin()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePegawaiRequest $request)
    {
        $validate=$request->validate([
            'nama'=>'required',
            'nip'=>'required',
            'tgl_lahir'=>'required',
            'agama'=>'required',
            'j_kelamin'=>'required',
            'id_kategori'=>'required',
            'id_pangkat'=>'required',
            'id_jabatan'=>'required',
            'id_departemen'=>'required',
        ]);

        Pegawai::insert($validate);
        $tgl = Pegawai::get('created_at')->date_format('Y-m-d');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePegawaiRequest  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
