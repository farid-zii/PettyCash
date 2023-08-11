<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pengajuan;
use App\Models\Saldo;
use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use DB;


class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $saldo= Pengajuan::get();
        $pegawai = Pegawai::get();

        if($saldo!=''){
        return view('admin2.index',[
            'title'=>'Dashboard',
            'active'=>'Dashboard',
            'saldo'=>$saldo,
            'pegawai'=>$pegawai
        ]);
        }

        return view('admin2.index', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'saldo' =>'',
            'pegawai' => $pegawai
        ]);
    }
    public function hrd(Request $r)
    {

        $datas='';

        if($r->tahun!=null){
            $datas = Pengajuan::select(\DB::raw("COUNT(*) as count"), DB::raw('MONTHNAME(created_at) as month_name'))
            ->whereYear('created_at', $r->tahun)
            ->groupBy(\DB::raw("MONTHNAME(created_at)"))
            ->orderBy('created_at', 'asc')
            ->pluck('count', 'month_name');
        }
        else{
            $datas=Pengajuan::select(\DB::raw("COUNT(*) as count"), DB::raw('MONTHNAME(created_at) as month_name'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("MONTHNAME(created_at)"))
            ->orderBy('created_at', 'asc')
            ->pluck('count','month_name');
        }


        $dataLabel = $datas->keys();
        $dataChart = $datas->values();

        $pegawai = Pegawai::get();
        $saldo = saldo::get();

        if ($saldo != '') {
            return view('admin.index', [
                'title' => 'Dashboard',
                'active' => 'Dashboard',
                'saldo' => $saldo,
                'pegawai' => $pegawai,
                'dataChart' => $dataChart,
                'dataLabel' => $dataLabel
            ]);
        }

        return view('admin.index', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'saldo'=>'',
            'pegawai'=> $pegawai,
            'dataChart' => $dataChart,
            'dataLabel' => $dataLabel

        ]);
    }

    public function finance(Request $r)
    {
        $datas = '';

        if ($r->tahun != null) {
            $datas = Pengajuan::select(\DB::raw("COUNT(*) as count"), DB::raw('MONTHNAME(created_at) as month_name'))
            ->whereYear('created_at', $r->tahun)
                ->groupBy(\DB::raw("MONTHNAME(created_at)"))
                ->orderBy('created_at', 'asc')
                ->pluck('count', 'month_name');
        } else {
            $datas = Pengajuan::select(\DB::raw("COUNT(*) as count"), DB::raw('MONTHNAME(created_at) as month_name'))
            ->whereYear('created_at', date('Y'))
                ->groupBy(\DB::raw("MONTHNAME(created_at)"))
                ->orderBy('created_at', 'asc')
                ->pluck('count', 'month_name');
        }


        $dataLabel = $datas->keys();
        $dataChart = $datas->values();

        $pegawai = Pegawai::get();
        $saldo = saldo::get();

        if ($saldo != '') {
            return view('finance.index', [
                'title' => 'Dashboard',
                'active' => 'Dashboard',
                'saldo' => $saldo,
                'pegawai' => $pegawai,
                'dataChart' => $dataChart,
                'dataLabel' => $dataLabel
            ]);
        }

        return view('finance.index', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'saldo' => '',
            'pegawai' => $pegawai,
            'dataChart' => $dataChart,
            'dataLabel' => $dataLabel

        ]);
    }

    public function pieChart()
    {

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
