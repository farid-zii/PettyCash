<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Alfa6661\AutoNumber\AutoNumberTtaits;

class Pengajuan extends Model
{
    use HasFactory;
    // use AutoNumberTtaits;

    protected $guarded = [
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    // public function getAutoNumberOptions()
    // {
    //     return [
    //         // kode dibawah adalah nama field yang ada pada table
    //         'kode' => [
    //             'format' => function () {
    //                 return date('Ym') . '?'; // autonumber format. '?' will be replaced with the generated number.
    //             },
    //             'length' => 3 // panjang nomor yg digenerate
    //             // 202304290001
    //             // 20230429 adalah tanggal pembuatan data
    //             // 0001 adalah panjang nomor yg digenerate
    //         ]
    //     ];
    // }

}
