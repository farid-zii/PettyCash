<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Saldo;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PegawaiRealisasiController extends Controller
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
        if ($saldos == null) {
            $saldo = 0;
        } else {
            $saldo = $saldos->total;
        }


        $awal = $req->input('awal');
        $akhir = $req->input('akhir');

        $data = '';
        $userId= Auth::user()->id;
        if ($req->awal && $req->akhir) {
            $data = Pengajuan::
            where('user_id','=',$userId)
            ->whereBetween('created_at', [$awal, $akhir])->where('approve', '=', 'Dicairkan')
            ->orWhere('approve', '=', 'Selesai')
            ->latest()
            ->get();
        } else {
            $data = Pengajuan::
            where('user_id','=',$userId)
            ->where('approve', '=', 'Dicairkan')
            ->orWhere('approve', '=', 'Selesai')
            ->latest()
            ->get();
        }

        return view('pegawai.realisasi.index', [
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
        // $validator = Validator::make($r->all(), [
        //     'bukti' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return back()->with('error', 'GAGAL');
        // }

        $pengajuan = Pengajuan::where('id', '=', $r->id)->first();
        // dd($pengajuan->nominalAcc);

        if ($r->hasFile('bukti_pakai')) {
            $nama = time() . '_' . $r->bukti_pakai->getClientOriginalName();
            $r->bukti_pakai->move(public_path('Storage/bukti_pakai'), $nama);

            //jika terpkai tidak sama dengan nominal yg diberikan
            if($r->terpakai != $pengajuan->nominalAcc){
                $refund = $pengajuan->nominalAcc - $r->terpakai;
                //jika bukti refund tidak kosong maka
                if($r->bukti_refund!=null){
                    $namaRefund = time() . '_' . $r->bukti_refund->getClientOriginalName();
                    $r->bukti_refund->move(public_path('Storage/bukti_refund'), $nama);

                    Pengajuan::find($r->id)->update([
                        'approve' => 'Selesai',
                        'bukti_pakai' => $nama,
                        'bukti_refund' => $namaRefund,
                        'refund' => $refund,
                        'total' => $r->terpakai,
                    ]);
                }else {
                    return back()->with('failed','Masukkan bukti refund / pengembalian kas');
                }
            }
            else {
                $refund = $pengajuan->nominalAcc - $r->terpakai;
                Pengajuan::find($r->id)->update([
                    'approve' => 'Selesai',
                    'bukti_pakai' => $nama,
                    'refund' => $refund,
                    'total' => $r->terpakai,
                ]);
            }

            $saldo = Saldo::latest()->first();
            $totalSaldo = $saldo->total + $refund;
            // dd($totalSaldo);
            Saldo::where('id', '=', $saldo->id)->update([
                'total' => $totalSaldo
            ]);

            transaksi::create([
                'pengajuan_id' => $r->id,
                'total'=>$totalSaldo
            ]);
        }
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
        //
    }
}
