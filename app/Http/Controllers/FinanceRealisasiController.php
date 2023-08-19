<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\realisasi;
use App\Models\saldo;
use DB;
use Illuminate\Support\Facades\Validator;

class FinanceRealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {


        // //Total Debit
        // $totalDebit = Pengajuan::select(DB::raw('SUM(debit) as total'))->where('approveF', '=', '✅')
        //     // ->where('type', '=', false)
        //     ->first();

        // //Total Kredit
        // $totalKredit = Pengajuan::select(DB::raw('SUM(kredit) as total'))
        // // ->where('type', '=', true)
        // ->first();

        $saldos = saldo::latest()->first();
        if ($saldos == null) {
            $saldo = 0;
        } else {
            $saldo = $saldos->total;
        }

        $awal = $req->input('awal');
        $akhir = $req->input('akhir');

        $data = '';
        if ($req->awal && $req->akhir) {
            $data = Pengajuan::whereBetween('created_at', [$awal, $akhir])->where('approve', '=', 'Setuju')->get();
        } else {
            $data = Pengajuan::where('approve', '=', 'Setuju')->get();
        }

        return view('finance.realisasi.index', [
            'active' => 'Realisasi',
            'title' => 'Realisasi',
            'pengajuan' => $data,
            'saldo' => $saldo,
            // 'tKredit'=>$ab
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
        //
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
        //
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
