<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'level' => 'admin',
            'password' => bcrypt('123456'),
            'email' => 'admin@example.com',
        ]);
    }
}
