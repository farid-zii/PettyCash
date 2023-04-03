<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.departemen.index',[
            "departemen"=>Departement::get(),
            "active"=>"Departemen",
            "title"=>"Departemen",
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
     * @param  \App\Http\Requests\StoreDepartementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartementRequest $request)
    {
        $validate=$request->validate([
            "nama"=>'required',
            "kode"=>'required',
        ]);

        Departement::create($validate);
        return redirect('/admin/departemen')->with('add','Create Data '.$validate['nama'].' Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartementRequest  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartementRequest $request,$id)
    {
        $update=$request->validate([
            'nama'=>'required',
            'kode'=>'required'
        ]);
        Departement::where('id',$id)->update($update);
        return redirect('/admin/departemen')->with('edit', 'Edit Data ' . $update['nama'] . ' Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement,$id)
    {
        Departement::destroy($id);
        return redirect('/admin/departemen')->with('delete', 'Delete Data Success');
    }
}
