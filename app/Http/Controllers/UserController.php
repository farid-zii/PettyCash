<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use App\Exports\UserExport;
use App\Models\Departemen;
use Illuminate\Support\Facades\Validator;
use PDF;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    public function getNamaUser(Request $request)
    {
        $keyword = $request->input('keyword');

        $result = User::where('nama', 'like', '%' . $keyword . '%')
            ->get();

        return response()->json($result);
    }


    public function index()
    {
        return view('admin.pegawai.index',[
            'user'=>User::get(),
            'departemen'=>Departemen::get(),
            'title'=>'Pegawai',
            'active'=>'Pegawai',
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
        User::create([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'nip'=>$request->nip,
            'jenisKelamin'=>$request->kelamin,
            'level'=>$request->level,
            'phone'=>$request->phone,
            'departemen_id'=>$request->departemen,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        return back()->with('success','Entry Data Berhasil');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        User::find($id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'nip' => $request->nip,
            'jenisKelamin' => $request->kelamin,
            'level' => $request->level,
            'phone' => $request->phone,
            'departemen_id' => $request->departemen,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Edit Data Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
