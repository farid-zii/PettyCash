<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $fillable =[
        'saldo','nominal'
    ];

    public function pegawai(){
        $this->belongsToMany(Pegawai::class);
    }
    public function transaksi()
    {
        $this->hasMany(transaksi::class);
    }
}
