<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pengajuan extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

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

}
