<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePengajuanRequest;
use App\Http\Requests\UpdatePengajuanRequest;
// use App\Models\Pengajuan;

use DB;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pengajuan.index',[
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
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
     * @param  \App\Http\Requests\StorePengajuanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengajuanRequest $request)
    {
        //jika waktu pembuatan beda sama sekarang maka $i=0
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'keterangan' => 'required',
            'nominal' => 'required',
            'bank'=>'required',
            'norek'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 200);
        }

        Pengajuan::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'bank'=> $request->bank,
            'norek'=> $request->norek
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengajuanRequest  $request
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengajuanRequest $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
