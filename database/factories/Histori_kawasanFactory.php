<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Histori_kawasan>
 */
class Histori_kawasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            //
            'id_kawasan' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(['Rendah','Sedang','Tinggi']), // Perubahan disini
            'waktu' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
