<?php

namespace App\Exports;

use App\Models\Pengajuan;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $keyword)
    {
        $this->name = $keyword;
        //Mengambil data dari ExportController/UserController
    }

#region
    //Digunakan ketika menggunakan implement collection
    // public function collection()
    // {
    //     return User::all();
    // }
#endregion
    public function view(): View
    {
        //Mencetak data excel berdasarkan template yang dibuat
        return view('admin2.user.excel',[
                    //Letak template excel
            'data'=>Pengajuan::query()->where('keterangan', 'like', '%' . $this->name . '%')->get()
                                        //Mencari data yang memili kata yang dicari
        ]);
    }

}
