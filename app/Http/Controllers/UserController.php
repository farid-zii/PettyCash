<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use App\Exports\UserExport;
use Illuminate\Support\Facades\Validator;
use PDF;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index',[
            'user'=>User::first()->get(),
            'title'=>'User',
            'active'=>'User',
        ]);
    }

    public function PengaturanAkun(Request $req){


        $id = $req->id;
        // $validator= Validator::make($req->all,[
        //     'name'=>'required',
        //     'password'=>'required',
        // ]);

        // if($validator->fails()){
        //     return response()->errors($validator,404);
        // }

        if($req->password!=$req->password2){
            return redirect('/profile')->with('failed','Edit Gagal Password beda');
        }

        $update = User::where('id',$id)->update([
            'name'=>$req->nama,
            'email'=>$req->email,
            'password'=> bcrypt($req->password),
        ]);

        // return response()->json($update, 200);
        return redirect('/profile')->with('success','Update berhasil');
    }

    public function pdf(){
        // $pdf= PDF::loadView('admin.user.excel',[
        //     'data'=>User::orderBy('name')->get()
        // ]);
        // $nama= User::where('id','=','1')->get('name');
        $pdf= PDF::loadView('admin.user.excel',[
            'data'=>User::orderBy('name')->get()
        ]);
        // return $pdf->download('user.pdf');
        return $pdf->setPaper('a4','landscape')->stream('user.pdf');
        //Membuat ukuran a4 dengan layout lanscape ---- nama pdf
    }

    public function excel(){
        return Excel::download(new UserExport('sd'), 'users.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create', [
            'user' => User::first()->get(),
            'title' => 'User',
            'active' => 'User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials=$request->validate([
            'name'=>'required',
            'password'=>'required|min:5',
            'email'=>'required|email:dns|min:10',
            'level'=>'required',
        ]);

        $credentials['password']= bcrypt($credentials['password']);
        User::create($credentials);
        return redirect('/admin/user')->with('success', 'Registrasion success, Please login your account');
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
        $update=$request->validate([
            'name'=>"required",
            'email'=>"required",
            'level'=>'required',
            'password'=>'required'
        ]);
        $update['password']=bcrypt($update['password']);
        User::Where('id', $id)->update($update);
        return redirect('admin/user')->with('Edit','Your editting success');
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
        return redirect('/admin/user')->with('pesan', 'Data Berhasil Dihapus');
    }
}
