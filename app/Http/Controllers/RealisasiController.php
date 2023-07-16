<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Services\AutoNumberService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePengajuanRequest;
use App\Http\Requests\UpdatePengajuanRequest;
use App\Models\Pegawai;
use Illuminate\Http\Request;
// use App\Models\Pengajuan;

use DB;

class RealisasiController extends Controller
{

    public function getProject(Request $request)
    {
        // if($request->ajax())
        // $keyword = $request->input('keyword');
        $keyword = $request->input('keyword');

        $result = Pengajuan::where('norek', 'like', '%' . $keyword . '%')
            //  ->pluck('nama')
            //  ->toArray();
            ->get();

        return response()->json($result);
    }
    public function pengajuan(){
        $data = Pengajuan::get();
        // $totalNominal=Pengajuan::where('type','=','penambahan')->latest()->get();

        return response()->json($data, 200);
    }

     public function index()
    {
        $data=Pengajuan::get();

        return view('admin.pengajuan.index',[
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
            'pengajuan'=>$data,
        ]);
    }
     public function index2()
    {
        $data=Pengajuan::get();
        // $totalNominal=Pengajuan::where('type','=','penambahan')->latest()->get();

        //Total Debit
        $totalDebit = Pengajuan::select('type',  DB::raw('SUM(nominal) as total'))
        ->where('type', '=', false)
        ->groupBy('type')
        ->first();

        //Total Kredit
        $totalKredit = Pengajuan::select('type', DB::raw('SUM(nominal) as total'))
        ->where('type', '=', true)
        ->groupBy('type')
        ->first();

        if($totalDebit == null && $totalKredit ==null){
            return view('admin.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => 0,
                'kredit' => 0,
                // 'tKredit'=>$ab
            ]);
        }
        if($totalDebit == null){
            return view('admin.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => 0,
                'kredit' => $totalKredit->total,
                // 'tKredit'=>$ab
            ]);
        }
        elseif($totalKredit ==null){
            return view('admin.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => $totalDebit->total,
                'kredit' => 0,
                // 'tKredit'=>$ab
            ]);
        }
        return view('admin.pengajuan.index',[
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
            'pengajuan'=>$data,
            'debit'=>$totalDebit->total,
            'kredit'=>$totalKredit->total,
            // 'tKredit'=>$ab
        ]);
    }


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
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'keterangan' => 'required',
            'bank' => 'required',
            'norek' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }

        $nama = Pegawai::where('nama', $request->nama)->first();

        $autoNumber = AutoNumberService::generateNumber();

        if ($request->type == 0) {
            $saldo = $request->saldo + $request->nominal;

            $data = Pengajuan::create([
                'kode' => $autoNumber,
                'pegawai_id' => $nama->id,
                'keterangan' => $request->keterangan,
                'project' => $request->project,
                'kredit' => $request->nominal,
                'bank' => $request->bank,
                'type' => $request->type,
                'norek' => $request->norek,
                'approveF' => '✅',
                'saldo' => $saldo,
            ]);

            return response()->json($data, 200);
        }

        if ($request->type == 1) {
            $data = Pengajuan::create([
                'kode' => $autoNumber,
                'pegawai_id' => $nama->id,
                'uraian' => $request->uraian,
                'project' => $request->project,
                'debit' => $request->nominal,
                'bank' => $request->bank,
                'type' => $request->type,
                'norek' => $request->norek,
                'approveF' => '⏹',
            ]);

            return response()->json($data, 200);
        }
    }


    public function awal(Request $request)
    {
        //jika waktu pembuatan beda sama sekarang maka $i=0
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'keterangan' => 'required',
            'nominal' => 'required',
            'bank'=>'required',
            'norek'=>'required',
        ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors(), 200);
        // }
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $nama=Pegawai::where('nama',$request->nama)->first();
        $autoNumber = AutoNumberService::generateNumber();
        if($request->type==false){

            $saldo=$request->saldo+$request->nominal;
            $data=Pengajuan::create([
                'kode'=> $autoNumber,
                'pegawai_id' => $nama->id,
                'keterangan' => $request->keterangan,
                'kredit' => $request->nominal,
                'bank'=> $request->bank,
                'type'=> $request->type,
                'project' => $request->project,
                'norek'=> $request->norek,
                'approveF'=> '✅',
                'saldo'=> $saldo,
            ]);
            return response()->json($data,200);
        }
        if($request->type==true){
            $data=Pengajuan::create([
                'kode' => $autoNumber,
                'pegawai_id' => $nama->id,
                'keterangan' => $request->keterangan,
                'project' => $request->project,
                'debit' => $request->nominal,
                'bank'=> $request->bank,
                'type'=> $request->type,
                'norek'=> $request->norek,
                'approveF'=> '⏹',
            ]);
            return response()->json($data, 200);
        }
    }


    public function financeAprrove(Request $r,$id)
    {
        if($r->type=='setuju'){
            $data=Pengajuan::where('id',$id)
                    ->update([
                        'approveF'=>'✅'
                    ]);
            // return back();
            return response()->json($data, 200);
        }
        if($r->type=='tolak'){
            $data=Pengajuan::where('id',$id)
                    ->update([
                        'approveF'=>'✅',
                        'komenF'=>$r->komen,
                    ]);
            return back();
            return response()->json($data, 200);
        }
    }

    public function direksiAprrove(Request $r,$id)
    {
        $pengajuan= Pengajuan::where('id', $id)->get();

        if($r->type=='setuju'){
            if($pengajuan->aooriveF== '✅'){
                $a=$pengajuan->saldo-$pengajuan->nominal;
                Pengajuan::where('id', $id)
                    ->update([
                        'approveD' => '✅',
                        'saldo' =>$a,
                    ]);
                return back();
            }
            Pengajuan::where('id',$id)
                    ->update([
                        'approveD'=>'✅'
                    ]);
            return back();
        }
        if($r->type=='tolak'){
            Pengajuan::where('id',$id)
                    ->update([
                        'approveD'=>'✅',
                        'komenD'=>$r->komen,
                    ]);
            return back();
        }
    }

    public function show(Pengajuan $pengajuan)
    {

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
    public function destroy($id)
    {
        $data = Pengajuan::destroy($id);

        return response()->json($data, 200);
    }
    public function delete($id)
    {
        $data=Pengajuan::destroy($id);

        return response()->json($data, 200);
    }
}
