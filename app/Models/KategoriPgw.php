<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPgw extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function pegawai(){
        $this->hasMany(Pegawai::class);
    }
}
