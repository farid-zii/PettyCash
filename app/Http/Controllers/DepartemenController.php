<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.departemen.index', [
            'datas' => Departemen::latest()->paginate(7),
            'active' => 'Departemen',
            'title' => 'Departemen',
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

        $nama = Departemen::where('kode', '=', $validate['kode'])->get('kode');

        if ($nama == true) {
            return redirect('/admin/departemen')->with('failed', 'Kode ' . $validate['kode'] . ' Sudah ada');
        }

        if ($nama == false) {
            Departemen::create($validate);
            return redirect('/admin/departemen')->with('add', 'Entry Data ' . $validate['nama'] . ' Success');
        } else {
            return redirect('/admin/departemen');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function show(Departemen $departemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function edit(Departemen $departemen,$id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departemen  $departemen
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


        $samaKode = Departemen::where('kode', '=', $update['kode'])->get('kode');
        $samaId = Departemen::where('id', '=', $id)->get('kode');

        //jika kode tidak sama dengan kode lama -> sama dengan kode yang ada -> update
        if ($samaId != $samaKode) {
            if ($samaId == $samaKode) {
                Departemen::where('id', $id)->update($update);
                return redirect('/admin/departemen')->with('edit', 'Update Data ' . $update['nama'] . ' Successa');
            }
            return redirect('/admin/departemen')->with('failed', 'Kode ' . $update['kode'] . ' Sudah ada ');
        }
        //Jika kode
        elseif ($samaKode == true) {
            Departemen::where('id', $id)->update($update);
            return redirect('/admin/departemen')->with('edit', 'Update Data ' . $update['nama'] . ' Success');
        }
        return redirect('/admin/departemen')->with('failed', 'Kode ' . $update['nama'] . ' Sudah ada ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Departemen::destroy($id);
        return redirect('/admin/departemen')->with('delete', 'Delete Data Success');
    }
}
