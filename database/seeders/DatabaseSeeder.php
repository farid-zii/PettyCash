<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pangkat;

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

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'level' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'admin@test.com',
        ]);
    }
}
