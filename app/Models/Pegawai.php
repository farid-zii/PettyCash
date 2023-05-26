<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded=[];
    // protected $with = ['pangkat'];

    public function bank(){
        return $this->belongsTo(Pengajuan::class);
    }
    public function pengajuan(){
        return $this->hasMany(Pengajuan::class);
    }
    public function saldo(){
        return $this->belongsToMany(Saldo::class);
    }
    // public function aa()
    // {
    //     return $this->belongsTo(KategoriPgw::class);
    // }
    // public function kategori()
    // {
    //     return $this->belongsTo(KategoriPgw::class, 'kategoriPgw_id');
    // }
    // public function pangkat()
    // {
    //     return $this->belongsTo(Pangkat::class);
    // }
    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
    // public function jabatan()
    // {
    //     return $this->belongsTo(jabatan::class);
    // }
}
