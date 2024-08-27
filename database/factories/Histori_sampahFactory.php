<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\histori_sampah>
 */
class Histori_sampahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ketinggian_sampah = $this->faker->randomFloat(2, 1, 10);
        $volume = $this->faker->randomFloat(2, 100, 500);
        $id_alat = $this->faker->numberBetween(1, 4);

        // Tentukan enum berdasarkan kondisi ketinggian_sampah dan volume
        if ($ketinggian_sampah < 5 && $volume < 200) {
            $keterangan = 'AMAN';
        } 
        if ($ketinggian_sampah > 5 && $ketinggian_sampah < 7 && $volume > 200 && $volume < 350) {
            $keterangan = 'WASPADA';
        }
        else {
            $keterangan = 'BAHAYA';
        }


        $start_date = strtotime('2024-01-01');
        $end_date = strtotime('2024-06-06');
        $random_timestamp = mt_rand($start_date, $end_date);
        $waktu = date("Y-m-d H:i:s", $random_timestamp);

        return [
            'ketinggian_sampah' => $ketinggian_sampah,
            'volume' => $volume,
            'keterangan' => $keterangan,
            'waktu' => $waktu,
            'id_alat' => $id_alat
        ];
    }
}