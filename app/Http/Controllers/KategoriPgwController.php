<?php

namespace App\Http\Controllers;

use App\Models\KategoriPgw;
use Illuminate\Http\Request;

class KategoriPgwController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Kategori.index', [
            'datas' => KategoriPgw::latest()->paginate(7),
            'active' => 'Kategori',
            'title' => 'Kategori',
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pesan = [
            'required' => ':attribute Wajib diisi !',
            'min' => ':attribute Harus diisi min :min karakter !',
            'max' => ':attribute Harus diisi max :max karakter !',
        ];
        $validate = $request->validate([
            "kode" => 'required|min:2|max:5',
            'nama' => 'required'
        ], $pesan);

        $nama = KategoriPgw::where('kode', '=', $validate['kode'])->get('kode');

        if ($nama == true) {
            return redirect('/admin/KategoriPgw')->with('failed', 'Kode ' . $validate['kode'] . ' Sudah ada');
        }

        if ($nama == false) {
            KategoriPgw::create($validate);
            return redirect('/admin/KategoriPgw')->with('add', 'Entry Data ' . $validate['nama'] . ' Success');
        } else {
            return redirect('/admin/KategoriPgw');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriPgw  $kategoriPgw
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriPgw $kategoriPgw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriPgw  $kategoriPgw
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriPgw $kategoriPgw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriPgw  $kategoriPgw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pesan = [
            'required' => ':attribute Wajib diisi !',
            'min' => ':attribute Harus diisi min :min karakter !',
            'max' => ':attribute Harus diisi max :max karakter !',
        ];

        $update = $request->validate([
            'kode' => 'required|min:2|max:5',
            'nama' => 'required',
        ], $pesan);


        $samaKode = KategoriPgw::where('kode', '=', $update['kode'])->get('kode');
        $samaId = KategoriPgw::where('id', '=', $id)->get('kode');

        //jika kode tidak sama dengan kode lama -> sama dengan kode yang ada -> update
        if ($samaId != $samaKode) {
            if ($samaId == $samaKode) {
                KategoriPgw::where('id', $id)->update($update);
                return redirect('/admin/KategoriPgw')->with('edit', 'Update Data ' . $update['nama'] . ' Successa');
            }
            return redirect('/admin/KategoriPgw')->with('failed', 'Kode ' . $update['kode'] . ' Sudah ada ');
        }
        //Jika kode
        elseif ($samaKode == true) {
            KategoriPgw::where('id', $id)->update($update);
            return redirect('/admin/kategoriPgw')->with('edit', 'Update Data ' . $update['nama'] . ' Success');
        }
        return redirect('/admin/kategoriPgw')->with('failed', 'Kode ' . $update['nama'] . ' Sudah ada ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriPgw  $kategoriPgw
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KategoriPgw::destroy($id);
        return redirect('/admin/kategoriPgw')->with('delete', 'Delete Data Success');
    }
}
