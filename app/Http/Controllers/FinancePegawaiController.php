<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\KategoriPgw;
use App\Models\Pangkat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinancePegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::latest()->paginate(7);
        $pegawai->transform(function ($data) {
            $tglLahir = Carbon::parse($data->tgl_lahir);
            $data->umur = $tglLahir->diffInYears(Carbon::now()) . ' tahun ' . $tglLahir->diffInMonths(Carbon::now()) % 12 . ' bulan';
            return $data;
        });

        $nomorUrut = ($pegawai->currentPage() - 1) * $pegawai->perPage() + 1;
        return view('Finance.pegawai.index', [
            "pegawai" => $pegawai,
            "kategori" => KategoriPgw::get(),
            "jabatan" => Jabatan::get(),
            "departemen" => Departemen::get(),
            "pangkat" => Pangkat::get(),
            'nomorUrut' => $nomorUrut,
            'title' => 'Pegawai',
            "active" => "Pegawai",
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
