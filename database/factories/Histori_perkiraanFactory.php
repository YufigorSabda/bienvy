<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Histori_perkiraan>
 */
class Histori_perkiraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_alat = $this->faker->numberBetween(1, 4);
        $id_parameter = $this->faker->numberBetween(1, 6);
        $nilai_parameter = 0;
        $keterangan = '';

        switch ($id_parameter) {
            case 1:
                $nilai_parameter = $this->faker->randomFloat(2, 15, 35);
                $keterangan = ($nilai_parameter < 25) ? 'AMAN' : 'BAHAYA';
                break;
            case 2:
                $nilai_parameter = $this->faker->randomFloat(2, 30, 60);
                $keterangan = ($nilai_parameter < 45) ? 'AMAN' : 'BAHAYA';
                break;
            case 3:
                $nilai_parameter = $this->faker->randomFloat(2, 50, 350);
                $keterangan = ($nilai_parameter < 200) ? 'AMAN' : 'BAHAYA';
                break;
            case 4:
                $nilai_parameter = $this->faker->randomFloat(2, 50, 250);
                $keterangan = ($nilai_parameter < 150) ? 'AMAN' : 'BAHAYA';
                break;
            case 5:
                $nilai_parameter = $this->faker->randomFloat(2, 10, 50);
                $keterangan = ($nilai_parameter < 30) ? 'AMAN' : 'BAHAYA';
                break;
            case 6:
                $nilai_parameter = $this->faker->randomFloat(2, 60, 240);
                $keterangan = ($nilai_parameter < 140) ? 'AMAN' : 'BAHAYA';
                break;
            default:
                break;
        }

        $start_date = strtotime('2024-06-20');
        $end_date = strtotime('2024-07-20');
        $random_timestamp = mt_rand($start_date, $end_date);
        $waktu = date("Y-m-d H:i:s", $random_timestamp);

        return [
            'id_alat' => 5,
            'id_parameter' => $id_parameter,
            'nilai_parameter' => $nilai_parameter,
            'keterangan' => $keterangan,
            'waktu' => $waktu
        ];
    }
}
