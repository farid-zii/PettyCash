<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\realisasi;
use App\Models\saldo;
use App\Models\transaksi;
use DB;
use Illuminate\Support\Facades\Validator;

class RealisasiController extends Controller
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
        // $totalDebit = Pengajuan::select(DB::raw('SUM(debit) as total'))->where('approveF', '=', '✅')
        // // ->where('type', '=', false)
        // ->first();


        // $totalKredit = Pengajuan::select('type', DB::raw('SUM(nominal) as total'))
        // ->where('type', '=', null)
        // ->groupBy('type')
        // ->first();

        // if($data->type=null){

        // }

        $saldos = saldo::latest()->first();
        if($saldos==null){
            $saldo= 0;
        }else{
            $saldo=$saldos->total;
        }


        $awal = $req->input('awal');
        $akhir = $req->input('akhir');

        $data = '';
        if ($req->awal && $req->akhir) {
            $data = Pengajuan::whereBetween('created_at', [$awal, $akhir])->where('approve', '=', 'Dicairkan')
            ->orWhere('approve', '=', 'Selesai')
            ->get();
        } else {
            $data = Pengajuan::where('approve', '=', 'Dicairkan')
            ->orWhere('approve', '=', 'Selesai')
            ->get();
        }


        return view('admin.realisasi.index', [
            'active' => 'Realisasi',
            'title' => 'Realisasi',
            'pengajuan' => $data,
            // 'debit' => $totalDebit->total,
            'saldo' => $saldo,
            // 'gambar' => $gambar,
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
            $validator = Validator::make($r->all(), [
                'bukti' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('error','GAGAL');
            }

            $pengajuan=Pengajuan::where('id','=',$r->id)->first();
            // dd($pengajuan->nominalAcc);
            if ($r->hasFile('bukti')) {
                    $nama = time() . '_' . $r->bukti->getClientOriginalName();
                    $r->bukti->move(public_path('img/bukti_pengajuan'), $nama);


                $refund= $pengajuan->nominalAcc - $r->terpakai;
                Pengajuan::find($r->id)->update([
                    'approve'=>'Selesai',
                    'bukti' => $nama,
                    'refund' => $refund,
                    'total' => $r->terpakai,
                ]);

                $saldo=Saldo::latest()->first();
                $totalSaldo =$saldo->total + $refund;
                // dd($totalSaldo);
                Saldo::where('id','=',$saldo->id)->update([
                    'total'=>$totalSaldo
                ]);

                transaksi::create([
                    'pengajuan_id'=>$r->id
                ]);
            }


        return back()->with('success', 'Bukti Berhasil di Tambakan');


}
    public function storeCadangan(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'inputs.*.gambars' => 'required'
            ]);

            if ($validator->fails()) {
                return back()->with('error','GAGAL');
            }

            $kode=$request->id;
            if ($request->hasFile('inputs.*.gambars')) {
                $gambars = $request->file('inputs.*.gambars');

                foreach ($gambars as $gambar) {
                    $nama = time() . '_' . $gambar->getClientOriginalName();
                    $gambar->move(public_path('img/bukti_pengajuan'), $nama);

                    realisasi::create([
                        'pengajuan_id'=>$kode,
                        'gambar' => $nama,
                    ]);
                }
            }

             $kodeR =realisasi::where('pengajuan_id','=',$kode)->get();
        Pengajuan::where('id', '=', $kode)->update([
            'realisasi_id' => $kodeR[0]->id,

        ]);

             $pemakaian=Pengajuan::where('id','=',$kode)->first();

        $total = $pemakaian->debit - $request->terpakai;

        $saldo = Saldo::latest()->first();

        $hasil = $saldo->total - $total;

        Saldo::where('id','=',$saldo->id)->update([
            'total' => $hasil
        ]);

        Pengajuan::where('id', '=', $kode)->update([
            'realisasi_id' => $kodeR[0]->id,
            'refund' => $total,
            'total' => $request->terpakai,
        ]);

        return back()->with('success', 'Bukti Berhasil di Tambakan');


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
        Pengajuan::where('id','=',$id)->update([
            'bukti'=>null,
        ]);

        return back();

    }
}
