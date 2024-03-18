<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // factory untuk produk
            'nama' => $this->faker->name,
            'harga' => $this->faker->numberBetween(1000, 100000),
            'stok' => $this->faker->numberBetween(1, 100),
        ];
    }
}
