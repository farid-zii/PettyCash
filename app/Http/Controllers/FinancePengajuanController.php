<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Services\AutoNumberService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePengajuanRequest;
use App\Http\Requests\UpdatePengajuanRequest;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Exports\PengajuanExport;
use App\Models\bank;
use App\Models\Saldo;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class FinancePengajuanController extends Controller
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
            $data = Pengajuan::whereBetween('created_at', [$awal, $akhir])->get();
        } else {
            $data = Pengajuan::get();
        }

        return view('finance.pengajuan.index', [
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
            'pengajuan' => $data,
            'bank' => bank::get(),
            'saldo' => $saldo
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
    public function store(Request $r)
    {
        $id=$r->id;


        // if ($r->setuju == 'setuju') {
            Pengajuan::where('id', $id)
                ->update([
                    'approveF' => '✅'
                ]);

            $pengajuan=Pengajuan::where('id','=', $id)->first();
            $saldo=Saldo::latest()->first();
            $hasil = $saldo->total - $pengajuan->debit;

            Saldo::where('id','=',$saldo->id)->update([
                'total'=>$hasil
            ]);

            return back();
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
    public function update(Request $r,$id)
    {
        if($r->tipe==1){
            Pengajuan::find($id)->update([
                'approve'=>'Setuju',
                'nominalAcc'=>$r->nominalAcc,
                'komen'=>$r->komen,
            ]);
            return back()->with('Success','Pengajuan telah di Setujui');
        }
        if($r->tipe==2){
            Pengajuan::find($id)->update([
                'approve'=>'Tolak',
                'komen'=>$r->komen,
            ]);
            return back()->with('Success','Pengajuan telah di Setujui');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
