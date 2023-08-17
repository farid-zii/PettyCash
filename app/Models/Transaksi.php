<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    public $guarded=[];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
    public function saldo()
    {
        return $this->belongsTo(Saldo::class);
    }
}
