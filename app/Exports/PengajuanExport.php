<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class PengajuanExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;
    protected $awal;
    protected $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
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
        return view('admin.pengajuan.excel', [
            //Letak template excel
            'data' => Pengajuan::where('approveF','=','✅')->whereBetween('created_at',[$this->awal,$this->akhir])->get(),
            'tanggal' => $this->awal .' Sampai '. $this->akhir
            //Mencari data yang memili kata yang dicari
        ]);
    }
}
