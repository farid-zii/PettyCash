<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    use HasFactory;

    protected $guarded= [];
    public function pegawai()
    {
        $this->hasMany(Pegawai::class);
    }
    public function pengajuan()
    {
        $this->hasMany(Pengajuan::class);
    }
}
