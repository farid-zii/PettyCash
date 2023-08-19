<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    use HasFactory;

    protected $guarded= [];
    public function pengajuan()
    {
       return $this->hasMany(Pengajuan::class);
    }
    
}
