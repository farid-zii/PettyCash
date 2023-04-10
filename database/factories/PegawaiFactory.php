<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama'=>fake()->name(),
            'nip'=>fake()->postcode(),
            'email'=>fake()->email(),
            'j_kelamin'=> fake()->randomElement(['Laki-laki', 'Perempuan']),
            'agama'=> fake()->randomElement(['Islam', 'Atheis']),
            'tgl_lahir'=>fake()->date(),
            'pangkat_id'=>mt_rand(1,8),
            'departemen_id'=>mt_rand(1,8),
            'jabatan_id'=>mt_rand(1,8),
            'kategoriPgw_id'=>mt_rand(1,8),
        ];
    }
}
