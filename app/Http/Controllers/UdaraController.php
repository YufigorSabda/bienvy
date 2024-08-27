<?php

namespace App\Http\Controllers;

use App\Models\Histori_kualitas;
use App\Models\parameter_kualitas_udara;
use Illuminate\Http\Request;
use App\Charts\GrafikChart;
use App\Charts\ChartParameter1;
use App\Charts\ChartParameter2;
use App\Charts\ChartParameter3;
use App\Charts\ChartParameter4;
use App\Charts\ChartParameter5;
use App\Charts\ChartParameter6;

class UdaraController extends Controller
{
    public function index(
        GrafikChart $chart,
        ChartParameter1 $chartParameter1,
        ChartParameter2 $chartParameter2,
        ChartParameter3 $chartParameter3,
        ChartParameter4 $chartParameter4,
        ChartParameter5 $chartParameter5,
        ChartParameter6 $chartParameter6,
        Request $request
    )
    {
        $parameter_kualitas_udara = parameter_kualitas_udara::all();

        $startDate = $request->input('start_date', date('Y-m-t'));
        $endDate = $request->input('end_date', date('Y-m-t'));

        // Query untuk mengambil histori kualitas berdasarkan rentang waktu
        if ($startDate && $endDate) {
            $histori_kualitas = Histori_kualitas::with('parameter_kualitas_udara')
                ->whereBetween('waktu', [$startDate, $endDate])
                ->get();
        } else {
            // Jika belum ada tanggal yang dipilih, ambil semua data histori kualitas
            $histori_kualitas = Histori_kualitas::with('parameter_kualitas_udara')->get();
        }

        return view('udara.index', [
            'chartParameter1' => $chartParameter1->build($startDate, $endDate),
            'chartParameter2' => $chartParameter2->build($startDate, $endDate),
            'chartParameter3' => $chartParameter3->build($startDate, $endDate),
            'chartParameter4' => $chartParameter4->build($startDate, $endDate),
            'chartParameter5' => $chartParameter5->build($startDate, $endDate),
            'chartParameter6' => $chartParameter6->build($startDate, $endDate),
            'histori_kualitas' => $histori_kualitas,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function chart()
    {
        $idParameters = [1, 2, 3, 4, 5, 6]; // Contoh ID parameter yang berbeda
        $chartParameters = [];

        foreach ($idParameters as $idParameter) {
            $chartParameters[] = Histori_kualitas::where('id_parameter', $idParameter)->pluck('nilai_parameter');
        }

        return view('lineChart', compact('chartParameters'));
    }
}
