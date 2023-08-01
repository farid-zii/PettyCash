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

        // $totalNominal=Pengajuan::where('type','=','penambahan')->latest()->get();

        //Total Debit
        $totalDebit = Pengajuan::select(DB::raw('SUM(debit) as total'))
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

        $saldos = Saldo::latest()->first();
        if ($saldos == null) {
            $saldo = 0;
        } else {
            $saldo = $saldos->saldo;
        }

        $awal = $req->input('awal');
        $akhir = $req->input('akhir');

        $data = '';
        if ($req->awal && $req->akhir) {
            $data = Pengajuan::whereBetween('created_at', [$awal, $akhir])->get();
        } else {
            $data = Pengajuan::get();
        }


        if ($totalDebit == null && $totalKredit == null) {
            return view('finance.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => 0,
                'kredit' => 0,
                'saldo' => $saldo
                // 'tKredit'=>$ab
            ]);
        }
        if ($totalDebit == null) {
            return view('finance.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => 0,
                'saldo' => $saldo,
                'kredit' => $totalKredit->total,
                // 'tKredit'=>$ab
            ]);
        } elseif ($totalKredit == null) {
            return view('finance.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => $totalDebit->total,
                'kredit' => 0,
                'saldo' => $saldo
                // 'tKredit'=>$ab
            ]);
        }
        return view('finance.pengajuan.index', [
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
            'pengajuan' => $data,
            'debit' => $totalDebit->total,
            'kredit' => $totalKredit->total,
            'saldo' => $saldo
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
    public function store(Request $r)
    {
        $id=$r->id;
        // if ($r->setuju == 'setuju') {
            $data = Pengajuan::where('id', $id)
                ->update([
                    'approveF' => '✅'
                ]);
            return back();
            // return response()->json($data, 200);
        // }
        // if ($r->type == 'tolak') {
        //     $data = Pengajuan::where('id', $id)
        //         ->update([
        //             'approveF' => '✅',
        //             'komenF' => $r->komen,
        //         ]);
        //     return back();
        //     return response()->json($data, 200);
        // }
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
            'approveF'=>'❌',
            'komenF'=>$request->alasan,
        ]);

        return back()->with('update','status berhasil ditambahkan');
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
