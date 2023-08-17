<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Departemen;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        Departemen::factory(8)->create();
        Pegawai::factory(8)->create();

        \App\Models\User::factory()->create(
            [
            'name' => 'finance',
            'level' => 'finance',
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
    }
}
