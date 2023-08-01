<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Http\Requests\StoreSaldoRequest;
use App\Http\Requests\UpdateSaldoRequest;
use DateTime;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saldos = saldo::latest()->first();
        if ($saldos == null) {
            $saldoNow = 0;
        } else {
            $saldoNow = $saldos->saldo;
        }
        return view('finance.saldo.index', [
            'datas' => Saldo::orderBy('id','DESC')->paginate(7),
            'title' => 'Saldo',
            'active' => 'Saldo',
            'saldoNow' => $saldoNow,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaldoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaldoRequest $request)
    {
        $saldo= $request->saldo;
        $nominal= $request->nominal;
        $status= $request->status;

        // DB::insert('insert into saldos (saldo, nominal, hasil) values (?, ?, ?)', [$saldo, $nominal,$hasil]);
        if($status=='Tambah'){
            $hasil = $saldo + $nominal;
            DB::table('saldos')->insert([
                'saldo'=>$saldo,
                'nominal'=>$nominal,
                'hasil'=>$hasil,
                'status' => $status,
                'created_at'=>new DateTime(),
            ]);
        }
        else{
            $hasil = $saldo - $nominal;
            DB::table('saldos')->insert([
                'saldo'=>$saldo,
                'nominal'=>$nominal,
                'hasil'=>$hasil,
                'status'=>$status,
                'created_at' => new DateTime(),
            ]);
        }

        // Saldo::insert([
        //     'saldo' => $saldo,
        //     'nominal' => $nominal,
        //     'hasil' => $hasil
        // ]);
        // Saldo::insert([
        //     'saldo'=>$hasil
        // ]);
        return back()->with('success','Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function show(Saldo $saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaldoRequest  $request
     * @param  \App\Models\Saldo  $saldo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaldoRequest $request, Saldo $saldo)
    {
        //
    }

    public function destroy($id)
    {
        Saldo::destroy($id);
        return back()->with('delete', 'Delete Data Success');
    }
}
