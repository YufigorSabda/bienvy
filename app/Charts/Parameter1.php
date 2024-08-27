<?php

namespace App\Charts;

use App\Models\Histori_kualitas;
use Illuminate\Support\Facades\DB;

class Parameter1
{
    public function build($startDate = null, $endDate = null): array
    {
        // Mendapatkan tanggal awal tahun terakhir (1 Januari)
        $startDate = now()->startOfYear();
        // Mendapatkan tanggal akhir tahun terakhir (31 Desember)
        $endDate = now()->endOfYear();

        $historiKualitas = Histori_kualitas::select(
            DB::raw("AVG(CASE WHEN id_parameter = 1 THEN nilai_parameter ELSE NULL END) as PM2_5"),
            DB::raw("AVG(CASE WHEN id_parameter = 2 THEN nilai_parameter ELSE NULL END) as PM10"),
            DB::raw("AVG(CASE WHEN id_parameter = 3 THEN nilai_parameter ELSE NULL END) as SO2"),
            DB::raw("AVG(CASE WHEN id_parameter = 4 THEN nilai_parameter ELSE NULL END) as NO2"),
            DB::raw("AVG(CASE WHEN id_parameter = 5 THEN nilai_parameter ELSE NULL END) as CO"),
            DB::raw("AVG(CASE WHEN id_parameter = 6 THEN nilai_parameter ELSE NULL END) as O3")
        )
        ->whereBetween('waktu', [$startDate, $endDate])
        ->whereIn('id_parameter', [1, 2, 3, 4, 5, 6]) // Only for specific parameter IDs
        ->first(); // Menggunakan first() karena kita hanya perlu satu baris hasil

        if (!$historiKualitas) {
            return []; // Jika tidak ada data yang ditemukan, kembalikan array kosong
        }

        $rataRataParameter = [
            'PM2_5' => round($historiKualitas->PM2_5, 2),
            'PM10' => round($historiKualitas->PM10, 2),
            'SO2' => round($historiKualitas->SO2, 2),
            'NO2' => round($historiKualitas->NO2, 2),
            'CO' => round($historiKualitas->CO, 2),
            'O3' => round($historiKualitas->O3, 2),
        ];

        return $rataRataParameter;
    }
}
