<?php

namespace App\Http\Controllers;

use App\Models\bank;
use App\Models\Pengajuan;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $saldos = Saldo::latest()->first();
        if ($saldos != null) {
            $saldo = $saldos->total;
        } else {
            $saldo = 0;
        }

        $awal = $req->input('awal');
        $akhir = $req->input('akhir');

        $data = '';
        if ($req->awal && $req->akhir) {
            $data = Pengajuan::whereBetween('created_at', [$awal, $akhir])->where('user_id','=',Auth::user()->id)
            ->latest()
            ->get();
        } else {
            $data = Pengajuan::where('user_id', '=', Auth::user()->id)->latest()->get();
        }

        if($data->count()!=0){
            $cek = $data->first()->approve;
        }
        else{
            $cek =$data;
        }

        return view('pegawai.pengajuan.index', [
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
            'pengajuan' => $data,
            'bank' => bank::get(),
            'saldo' => $saldo,
            'cek'=>$cek
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pengajuan::create([
            'user_id'=>$request->user_id,
            'nominal'=>$request->nominal,
            'bank_id'=>$request->bank,
            'norek'=>$request->norek,
            'keterangan'=>$request->keterangan,
            'approve'=>'Menunggu',
        ]);

        return back()->with('success','Data Pengajuan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Pengajuan::find($id)->update([
            'nominal' => $request->nominal,
            'bank_id' => $request->bank,
            'norek' => $request->norek,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success','Data Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengajuan::destroy($id);

        return back()->with('success', 'Data berhasil dihapus');
    }
}
