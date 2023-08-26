<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Services\AutoNumberService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePengajuanRequest;
use App\Http\Requests\UpdatePengajuanRequest;
use Illuminate\Http\Request;
use App\Exports\PengajuanExport;
use App\Models\bank;
use App\Models\Saldo;
use App\Models\User;
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
        $keyword = $request->input('keyword');

        $result = Pengajuan::where('project', 'like', '%' . $keyword . '%')
        ->get();

        return response()->json($result);
    }

    public function getNorek(Request $request)
    {
        // if($request->ajax())
        // $keyword = $request->input('keyword');
        $keyword = $request->input('keyword');
        $result = Pengajuan::where('norek', 'like', '%' . $keyword . '%')
        ->get();

        return response()->json($result);
    }

     public function index(Request $req)
    {
        $saldos = Saldo::latest()->first();
        if ($saldos != null) {
            $saldo = $saldos->total;
        } else {
            $saldo = 0;
        }

            $awal=$req->input('awal');
            $akhir=$req->input('akhir');

        $data = '';
        if($req->awal && $req->akhir){
             $data = Pengajuan::whereBetween('created_at',[$awal,$akhir])->latest()->get();
        }
        else {
            $data = Pengajuan::latest()->get();
        }


        return view('admin.pengajuan.index',[
            'active' => 'Pengajuan',
            'title' => 'Pengajuan',
            'pengajuan'=>$data,
            'bank'=>bank::get(),
            'saldo' => $saldo
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

        $nama = User::where('nama', $request->nama)->first();

        // $autoNumber = AutoNumberService::generateNumber();

            $saldo = $request->saldo + $request->nominal;

            Pengajuan::create([
                'user_id' => $nama->id,
                'keterangan' => $request->keterangan,
                'nominal' => $request->nominal,
                'bank_id' => $request->bank,
                'norek' => $request->norek,
                'approve' => 'Menunggu',
            ]);

            // return response()->json($data, 200);
            return back()->with('success','Data Berhasil ditambahkan');
    }

    public function show(Pengajuan $pengajuan)
    {


    }

    public function update(Request $req,$id)
    {

            $nama=time().'_'.$req->bukti_tf->getClientOriginalName();
            $req->bukti_tf->move(public_path('Storage/bukti_pencairan'), $nama);

            $data=Pengajuan::where('id','=',$id)->first();
            Pengajuan::where('id','=',$id)->update([
                'approve'=>'Dicairkan',
                'bukti_tf'=>$nama
            ]);

            $saldo=Saldo::latest()->first();
            $hasil = $saldo->total - $data->nominalAcc;
            Saldo::where('id','=',$saldo->id)->update([
                'total'=>$hasil,
            ]);
            return back()->with('success', 'Dana Telah Dicairkan');
    }


    public function edit(Request $req){

            Pengajuan::find($req->id)->update([
                'keterangan' => $req->keterangan,
                'bank_id' => $req->bank,
                'norek' => $req->norek,
                'nominal' => $req->nominal,
            ]);
            return back()->with('success', 'Data Berhasil Di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengajuan::destroy($id);

        return back()->with('success','Data berhasil dihapus');
    }
}
