<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\KategoriPgw;
use App\Models\Pangkat;

use Illuminate\Http\Request;
use DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //   $namaP= DB::select('select pangkats.nama from pegawais left join pangkats on pegawais.pangkat_id = pangkats.id');

        return view('admin.pegawai.index',[
            "pegawai"=>Pegawai::latest()->paginate(7),
            "kategori"=>KategoriPgw::get(),
            "jabatan"=>Jabatan::get(),
            "departemen"=>Departemen::get(),
            "pangkat"=>Pangkat::get(),
            'title'=>'Pegawai',
            "active"=>"Pegawai",
        ]);
    }
    public function searchNama(Request $request)
    {
        // if($request->ajax())
        // $keyword = $request->input('keyword');
        $keyword = $request->input('keyword');

        $result =Pegawai::where('nama','like',$keyword.'%')
                 ->pluck('nama')
                 ->toArray();
                // ->get();

         return response()->json($result);
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
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePegawaiRequest $request)
    {

        $validate=$request->validate([
            'nama'=>'required',
            'nip'=>'required',
            'tgl_lahir'=>'required',
            'agama'=>'required',
            'email'=>'required|email:dns',
            'profil'=>'max:4096',
            'j_kelamin'=>'required',
            'jabatan_id'=>'required',
            'departemen_id'=>'required',
        ]);

        // $validate['profil']==$gambar;
        if ($request->hasFile('profil')) {
            //jika request memiliki file dengan name profil maka -->
            $nama= $request->file('profil')->getClientOriginalName();
            $request->file('profil')->move(public_path('img/profil_Pegawai'),$nama);
            //Memindahkan file ke public/profil_pegawai dengan nama asli file
            $validate['profil'] = $nama;
            //Mengubah nama file menjadi nama asli sesuai nama file di direktori
        }


        Pegawai::create($validate);
        return back()->with('add','Entry data Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePegawaiRequest  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePegawaiRequest $request, $id)
    {
         $validate=$request->validate([
            'nama'=>'required',
            'nip'=>'required',
            'tgl_lahir'=>'required',
            'agama'=>'required',
            'email'=>'required|email:dns',
            'profil'=>'max:4096',
            'j_kelamin'=>'required',
            'jabatan_id'=>'required',
            'departemen_id'=>'required',
        ]);


        // $gambar = $request->file('profil');
        // $nama_file = time() . "_" . $gambar->getClientOriginalName();
        // $tujuan_upload = 'profil_Pegawai';
        // $gambar->move(public_path($tujuan_upload), $nama_file);
        // $file_extention= $gambar->extension();
        // $nama_gambar = date('ydmhis').'.'.$file_extention;
        // $gambar->move(public_path('profilPegawai'),$nama_gambar);

        // $validate['profil']==$gambar;
        if ($request->hasFile('profil')) {
            //jika request memiliki file dengan name profil maka -->
            $nama= $request->file('profil')->getClientOriginalName();
            $request->file('profil')->move(public_path('img/profil_Pegawai'),$nama);
            //Memindahkan file ke public/profil_pegawai dengan nama asli file
            $validate['profil'] = $nama;
            //Mengubah nama file menjadi nama asli sesuai nama file di direktori
        }


        Pegawai::where('id',$id)->update($validate);
        return back()->with('update','Update data Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::destroy($id);
        return back()->with('delete', 'Delete Data Success');
    }
}
