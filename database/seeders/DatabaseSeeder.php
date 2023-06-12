<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\KategoriPgw;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\Pengajuan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(4)->create();
        Pangkat::factory(8)->create();
        Departemen::factory(8)->create();
        KategoriPgw::factory(8)->create();
        Jabatan::factory(8)->create();
        Pegawai::factory(8)->create();

        \App\Models\User::factory()->create(
            [
            'name' => 'Admin',
            'level' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'admin@test.com',
        ],
    );
        \App\Models\User::factory()->create(
            [
            'name' => 'PettyCash Admin',
            'level' => 'hrd',
            'password' => bcrypt('123456'),
            'email' => 'hrd@test.com',
        ],
    );

        \App\Models\Pengajuan::factory()->create(
            [
            'pegawai_id' => '1',
            'bank' => 'BRI',
            'keterangan' => 'sadsadas',
            'norek' => '1231312',
            'type' => 'penambahan',
            'saldo'=>'2000',
            'nominal'=>'2000',
            'approveD'=>'✅',
            'approveF'=>'✅',
        ],
    );
    }
}
