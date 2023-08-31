<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Idkategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Idkategori::create([
            'id_kategori' => 'Romance',
        ]);
        Idkategori::create([
            'id_kategori' => 'Horor',
        ]);
        Idkategori::create([
            'id_kategori' => 'Comedy',
        ]);
    }
}
