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

use DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //   $namaP= DB::select('select pangkats.nama from pegawais left join pangkats on pegawais.pangkat_id = pangkats.id');

        return view('admin.pegawai.index',[
            "pegawai"=>Pegawai::latest()->paginate(7),
            "kategori"=>KategoriPgw::get(),
            "jabatan"=>Jabatan::get(),
            "departemen"=>Departemen::get(),
            "pangkat"=>Pangkat::get(),
            'title'=>'Pegawai',
            "active"=>"Pegawai",
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
            'email'=>'required|email:dns',
            'profil'=>'max:2048',
            'j_kelamin'=>'required',
            'kategoriPgw_id'=>'required',
            'pangkat_id'=>'required',
            'jabatan_id'=>'required',
            'departemen_id'=>'required',
        ]);


        // $gambar = $request->file('profil');
        // $nama_file = time() . "_" . $gambar->getClientOriginalName();
        // $tujuan_upload = 'profil_Pegawai';
        // $gambar->move($tujuan_upload, $nama_file);

        Pegawai::create($validate);
        if ($request->hasFile('profil')) {
            $request->file('profile')->store('profilPegawai');
            $validate['profil'] = $request->file('profil')->getClientOriginalName();
            $validate['profil']->save();
        }
        return back()->with('add','Entry data Success');

        // Pegawai::create([
        //     'nama' => 'required',
        //     'nip' => 'required',
        //     'tgl_lahir' => 'required',
        //     'agama' => 'required',
        //     'profil' => $gambar,
        //     'j_kelamin' => 'required',
        //     'kategoriPgw_id' => 'required',
        //     'pangkat_id' => 'required',
        //     'jabatan_id' => 'required',
        //     'departemen_id' => 'required',
        // ]);


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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::destroy($id);
        return back()->with('delete', 'Delete Data Success');
    }
}
