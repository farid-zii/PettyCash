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

        $pegawai = Pegawai::latest()->paginate(7);
        $pegawai->transform(function ($data) {
            $tglLahir = Carbon::parse($data->tgl_lahir);
            $data->umur = $tglLahir->diffInYears(Carbon::now()) . ' tahun ' . $tglLahir->diffInMonths(Carbon::now()) % 12 . ' bulan';
            return $data;
        });

        $nomorUrut = ($pegawai->currentPage() - 1) * $pegawai->perPage() + 1;
        return view('admin.pegawai.index',[
            "pegawai"=>$pegawai,
            "kategori"=>KategoriPgw::get(),
            "jabatan"=>Jabatan::get(),
            "departemen"=>Departemen::get(),
            "pangkat"=>Pangkat::get(),
            'nomorUrut' => $nomorUrut,
            'title'=>'Pegawai',
            "active"=>"Pegawai",
        ]);
    }
    public function searchNama(Request $request)
    {
        // if($request->ajax())
        // $keyword = $request->input('keyword');
        $keyword = $request->input('keyword');

        $result =Pegawai::where('nama','like','%'.$keyword.'%')
                //  ->pluck('nama')
                //  ->toArray();
                ->get();

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
            $nama= time().$request->file('profil')->getClientOriginalName();
            $request->file('profil')->move(public_path('img/profil_Pegawai'),$nama);
            //Memindahkan file ke public/img/profil_pegawai dengan nama asli file
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
            'agama'=> 'nullable',
            'email'=>'required|email:dns',
            'profil'=>'nullable|max:4096',
            'j_kelamin'=>'required',
            'jabatan_id'=>'required',
            'departemen_id'=>'required',
        ]);

        if ($request->hasFile('profil')) {
            //jika request memiliki file dengan name profil maka -->
            $nama = time().$request->file('profil')->getClientOriginalName();
            $request->file('profil')->move(public_path('img/profil_Pegawai'), $nama);
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
        $data = Pegawai::where('id',$id)->get('profil');
        $data2 = Pegawai::findOrFail($id);

        //hapus gambar pada penyimpanan
        Storage::delete('public/img/profil_Pegawai/'.$data);
        // Storage::delete('public/img/profil_Pegawai/'.$data->profil);

        //hapus data pada database
        $data2->delete();


        return back()->with('delete', 'Delete Data Success');
    }
}
