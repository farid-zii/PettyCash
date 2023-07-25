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
use Maatwebsite\Excel\Facades\Excel;
// use App\Models\Pengajuan;

use DB;

class PengajuanController extends Controller
{

    public function excel(Request $req)
    {
        $awal = $req->awal;
        $akhir = $req->akhir;
        // $akhir = $req->input('akhir');
        return Excel::download(new PengajuanExport($awal,$akhir), 'Pengajuan'.$awal.'-'.$akhir.'.xlsx');
    }

    public function getProject(Request $request)
    {
        // if($request->ajax())
        // $keyword = $request->input('keyword');
        $keyword = $request->input('keyword');

        $result = Pengajuan::where('project', 'like', '%' . $keyword . '%')
            //  ->pluck('nama')
            //  ->toArray();
            ->get();

        return response()->json($result);
    }

    public function getNorek(Request $request)
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


        return datatables()->of($data)->make(true);
        // return response()->json($data, 200);
    }

    //  public function index2()
    // {
    //     $data=Pengajuan::get();

    //     return view('admin.pengajuan.index',[
    //         'active' => 'Pengajuan',
    //         'title' => 'Pengajuan',
    //         'pengajuan'=>$data,
    //     ]);
    // }
     public function index(Request $req)
    {

        // $totalNominal=Pengajuan::where('type','=','penambahan')->latest()->get();

        //Total Debit
        $totalDebit = Pengajuan::select(  DB::raw('SUM(debit) as total'))
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

            $awal=$req->input('awal');
            $akhir=$req->input('akhir');

        $data = '';
        if($req->awal && $req->akhir){
             $data = Pengajuan::whereBetween('created_at',[$awal,$akhir])->get();
        }
        else {
            $data = Pengajuan::get();
        }


        if($totalDebit == null && $totalKredit ==null){
            return view('admin.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => 0,
                'kredit' => 0,
                'saldo'=>$saldo
                // 'tKredit'=>$ab
            ]);
        }
        if($totalDebit == null){
            return view('admin.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => 0,
                'saldo' => $saldo,
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
                'saldo' => $saldo
                // 'tKredit'=>$ab
            ]);
        }
        return view('admin.pengajuan.index',[
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
            'pengajuan'=>$data,
            'debit'=>$totalDebit->total,
            'kredit'=>$totalKredit->total,
            'saldo' => $saldo
            // 'tKredit'=>$ab
        ]);
    }

     public function index_finance(Request $req)
    {

        // $totalNominal=Pengajuan::where('type','=','penambahan')->latest()->get();

        //Total Debit
        $totalDebit = Pengajuan::select(  DB::raw('SUM(debit) as total'))
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

            $awal=$req->input('awal');
            $akhir=$req->input('akhir');

        $data = '';
        if($req->awal && $req->akhir){
             $data = Pengajuan::whereBetween('created_at',[$awal,$akhir])->get();
        }
        else {
            $data = Pengajuan::get();
        }


        if($totalDebit == null && $totalKredit ==null){
            return view('finance.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => 0,
                'kredit' => 0,
                'saldo'=>$saldo
                // 'tKredit'=>$ab
            ]);
        }
        if($totalDebit == null){
            return view('finance.pengajuan.index', [
                'active' => 'Pengajuan',
                'title' => 'Pengajuan',
                'pengajuan' => $data,
                'debit' => 0,
                'saldo' => $saldo,
                'kredit' => $totalKredit->total,
                // 'tKredit'=>$ab
            ]);
        }
        elseif($totalKredit ==null){
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
        return view('finance.pengajuan.index',[
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
            'pengajuan'=>$data,
            'debit'=>$totalDebit->total,
            'kredit'=>$totalKredit->total,
            'saldo' => $saldo
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
            // return response()->json($validator->errors(), 200);
            return back()->with('failed','ERROR PASTIKAN SEMUA DATA DI ISI');
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

            // return response()->json($data, 200);
            return back()->with('success','Data Berhasil ditambahkan');

        }

        if ($request->type == 1) {
            $data = Pengajuan::create([
                'kode' => $autoNumber,
                'pegawai_id' => $nama->id,
                'keterangan' => $request->keterangan,
                'project' => $request->project,
                'debit' => $request->nominal,
                'bank' => $request->bank,
                'type' => $request->type,
                'norek' => $request->norek,
                'approveF' => '⏹',
            ]);

            // return response()->json($data, 200);
            return back()->with('success', 'Data Berhasil ditambahkan');
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
    public function editPengajuan(Request $req)
    {
        if($req->type==1){
            Pengajuan::where('id',$req->id)
            ->update([
                'project'=>$req->project,
                'kredit'=>$req->nominal,
                'debit'=>'0',
                'type' => $req->type,
                'norek'=>$req->norek,
                'bank'=>$req->bank,
                'keterangan'=>$req->keterangan,
            ]);

            return back()->with('edit',"EDIT DATA BERHASIL");
        }
        if($req->type==0){
            Pengajuan::where('id',$req->id)
            ->update([
                'project'=>$req->project,
                'type'=>$req->type,
                'kredit'=>'0',
                'debit'=>$req->nominal,
                'norek'=>$req->norek,
                'bank'=>$req->bank,
                'keterangan'=>$req->keterangan,
            ]);

            return back()->with('edit',"EDIT DATA BERHASIL");
        }
    }
    // public function edit(Request $req)
    // {
    //     if($req->type==1){
    //         Pengajuan::where('id',$req->id)
    //         ->update([
    //             'project'=>$req->project,
    //             'kredit'=>$req->nominal,
    //             'debit'=>$req->nominal,
    //             'norek'=>$req->norek,
    //             'bank'=>$req->bank,
    //             'keterangan'=>$req->keterangan,
    //         ]);

    //         return back()->with('edit',"EDIT DATA BERHASIL");
    //     }
    //     if($req->type==0){
    //         Pengajuan::where('id',$req->id)
    //         ->update([
    //             'project'=>$req->project,
    //             'kredit'=>$req->nominal,
    //             'debit'=>$req->nominal,
    //             'norek'=>$req->norek,
    //             'bank'=>$req->bank,
    //             'keterangan'=>$req->keterangan,
    //         ]);

    //         return back()->with('edit',"EDIT DATA BERHASIL");
    //     }
    // }


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
