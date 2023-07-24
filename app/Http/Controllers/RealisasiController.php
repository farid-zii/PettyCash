<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\realisasi;
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

        $saldo = 40000;

        $awal = $req->input('awal');
        $akhir = $req->input('akhir');

        $data = '';
        if ($req->awal && $req->akhir) {
            $data = Pengajuan::whereBetween('created_at', [$awal, $akhir])->where('approveF', '=', '✅')->get();
        } else {
            $data = Pengajuan::where('approveF', '=', '✅')->get();
        }

        $gambar=realisasi::get();


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
            'realisasi_id' => $kodeR[0]->id
        ]);

             $pemakaian=Pengajuan::where('id','=',$kode)->get();


            foreach ($pemakaian as $data) {
            if ($data->type == 1) {
                $total=$data->debit - $request->terpakai;

                Pengajuan::where('id', '=', $kode)->update([
                    'realisasi_id' => $kodeR[0]->id,
                    'refund'=>$request->terpakai,
                    'total'=>$total,
                ]);

                return back()->with('success', 'Bukti Berhasil di Tambakan');
            }
            }


             Pengajuan::where('id','=',$kode)->update([
                'realisasi_id'=> $kodeR[0]->id
            ]);

            return back()->with('success', 'Bukti Berhasil di Tambakan');
            // "Gambar berhasil diunggah!";

    }



    //     {
//         $validator = Validator::make($request->all(), [
//             'gambars' => 'required'
//         ]);

//         if($validator->fails()){
//             return redirect()
//             ->withErrors($validator)
//             ->withInput();
//         }

//     if ($request->hasFile('gambars')) {
//         $gambars = $request->file('gambars');

//         foreach ($gambars as $gambar) {
//             $nama = time() . '_' . $gambar->getClientOriginalName();
//             $gambar->move(public_path('img/bukti_pengajuan'), $nama);

//             Realisasi::create([
//                 'pengajuan_id' => $request->pengajuan_id,
//                 'gambar' => $nama,
//             ]);
//         }

//         return back()->with('success','Bukti Berhasil di Tambakan');
//         // "Gambar berhasil diunggah!";
//     }
// }

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

        realisasi::where('pengajuan_id','=',$id)->delete();
        // realisasi::destroy($id);
        Pengajuan::where('id','=',$id)->update([
            'realisasi_id'=>null,
            'refund'=>null,
            'total'=>null,
        ]);

        return back();

    }
}
