<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
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

        $a=Pengajuan::select(DB::raw('MAX(RIGHT(kode,2))as kode'));
        $kd='';
        if($a->count()>0){
            foreach ($a->get() as $b) {
                $tmp = ((int)$b->kode)+1;
                $kd =sprintf('%02s',$tmp);
            }
        }
        else {
            $kd=date('ymd').'01';
        }
    //
    //    for($i= 0 ; $i<10; $i++){
    // for($y=0; $y<10; $y++){
    //  echo("aaa"+i+y)
    // }}
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
     * @param  \App\Http\Requests\StorePengajuanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengajuanRequest $request)
    {
        //jika waktu pembuatan beda sama sekarang maka $i=0

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
