<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Http\Requests\StoreJabatanRequest;
use App\Http\Requests\UpdateJabatanRequest;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.jabatan.index',[
            'jabatan'=>Jabatan::orderBy('id')->paginate(7),
            'active'=>'Jabatan',
            'title'=>'Jabatan'
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
     * @param  \App\Http\Requests\StoreJabatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJabatanRequest $request)
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

        $nama = Jabatan::where('kode', '=', $validate['kode'])->get('kode');

        if ($nama == true) {
            return redirect('/admin/jabatan')->with('failed', 'Kode ' . $validate['kode'] . ' Sudah ada');
        }

        if ($nama == false) {
            Jabatan::create($validate);
            return redirect('/admin/jabatan')->with('add', 'Entry Data ' . $validate['nama'] . ' Success');
        } else {
            return redirect('/admin/jabatan');
        }
    }
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJabatanRequest  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJabatanRequest $request,$id)
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


        $samaKode = Jabatan::where('kode', '=', $update['kode'])->get('kode');
        $samaId = Jabatan::where('id', '=', $id)->get('kode');

        //jika kode tidak sama dengan kode lama -> sama dengan kode yang ada -> update
        if ($samaId != $samaKode) {
            if ($samaId == $samaKode) {
                Jabatan::where('id', $id)->update($update);
                return redirect('/admin/jabatan')->with('edit', 'Update Data ' . $update['nama'] . ' Successa');
            }
            return redirect('/admin/jabatan')->with('failed', 'Kode ' . $update['kode'] . ' Sudah ada ');
        }
        //Jika kode
        elseif ($samaKode == true) {
            Jabatan::where('id', $id)->update($update);
            return redirect('/admin/jabatan')->with('edit', 'Update Data ' . $update['nama'] . ' Success');
        }
        return redirect('/admin/jabatan')->with('failed', 'Kode ' . $update['nama'] . ' Sudah ada ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jabatan::destroy($id);
        return redirect('/admin/jabatan')->with('delete','Delete Data Success');
    }
}
