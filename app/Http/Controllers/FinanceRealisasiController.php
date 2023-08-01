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

        // $totalNominal=Pengajuan::where('type','=','penambahan')->latest()->get();

        //Total Debit
        $totalDebit = Pengajuan::select(DB::raw('SUM(debit) as total'))->where('approveF', '=', '✅')
            // ->where('type', '=', false)
            ->first();

        //Total Kredit
        $totalKredit = Pengajuan::select(DB::raw('SUM(kredit) as total'))
        // ->where('type', '=', true)
        ->first();

        // $totalKredit = Pengajuan::select('type', DB::raw('SUM(nominal) as total'))
        // ->where('type', '=', null)
        // ->groupBy('type')
        // ->first();

        // if($data->type=null){

        // }
        $saldos = saldo::latest()->first();
        if ($saldos == null) {
            $saldo = 0;
        } else {
            $saldo = $saldos->saldo;
        }

        $awal = $req->input('awal');
        $akhir = $req->input('akhir');

        $data = '';
        if ($req->awal && $req->akhir) {
            $data = Pengajuan::whereBetween('created_at', [$awal, $akhir])->where('approveF', '=', '✅')->get();
        } else {
            $data = Pengajuan::where('approveF', '=', '✅')->get();
        }

        $gambar = realisasi::get();


        if ($totalDebit == null && $totalKredit == null) {
            return view('admin.realisasi.index', [
                'active' => 'Realisasi',
                'title' => 'Realisasi',
                'pengajuan' => $data,
                'debit' => 0,
                'kredit' => 0,
                'saldo' => $saldo,
                'gambar' => $gambar,
                // 'tKredit'=>$ab
            ]);
        }
        if ($totalDebit == null) {
            return view('admin.realisasi.index', [
                'active' => 'Realisasi',
                'title' => 'Realisasi',
                'pengajuan' => $data,
                'debit' => 0,
                'saldo' => $saldo,
                'kredit' => $totalKredit->total,
                'gambar' => $gambar,
                // 'tKredit'=>$ab
            ]);
        } elseif ($totalKredit == null) {
            return view('admin.realisasi.index', [
                'active' => 'Realisasi',
                'title' => 'Realisasi',
                'pengajuan' => $data,
                'debit' => $totalDebit->total,
                'kredit' => 0,
                'gambar' => $gambar,
                'saldo' => $saldo
                // 'tKredit'=>$ab
            ]);
        }
        return view('admin.realisasi.index', [
            'active' => 'Realisasi',
            'title' => 'Realisasi',
            'pengajuan' => $data,
            'debit' => $totalDebit->total,
            'kredit' => $totalKredit->total,
            'saldo' => $saldo,
            'gambar' => $gambar,
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
