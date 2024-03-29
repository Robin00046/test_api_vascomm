<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Produk::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(ProdukSeeder::class);
    }
}
