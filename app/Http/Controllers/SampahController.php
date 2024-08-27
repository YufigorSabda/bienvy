<?php

namespace App\Http\Controllers;

use App\Models\Histori_sampah;
use Illuminate\Http\Request;
use App\Charts\SampahChart;

class SampahController extends Controller
{
    public function index(SampahChart $chart, Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika kedua tanggal tidak diberikan, atur ke awal tahun berjalan hingga saat ini
        if (!$startDate && !$endDate) {
            $startDate = date('Y-01-01'); // Tanggal awal: 1 Januari tahun berjalan
            $endDate = date('Y-m-d'); // Tanggal akhir: tanggal saat ini
        }


        $historiSampah = Histori_sampah::with('ReferensiAlat.Kawasan')
            ->whereBetween('waktu', [$startDate, $endDate])
            ->get();

        return view('sampah.index', [
            'histori_sampah' => $chart->build($startDate, $endDate),
            'histori' => $historiSampah
        ]);
    }

    public function chart()
    {
        $histori_sampah = Histori_sampah::all();
        return view('barChart', compact('histori_sampah'));
    }

    public function fetchChartData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (!$startDate && !$endDate) {
            $startDate = date('Y-01-01'); // Tanggal awal: 1 Januari tahun berjalan
            $endDate = date('Y-m-d'); // Tanggal akhir: tanggal saat ini
        }

        $histori_sampah = Histori_sampah::with('referensiAlat.kawasan')
            ->whereBetween('waktu', [$startDate, $endDate])
            ->get();

        $labels = $histori_sampah->pluck('waktu')->toJson();
        $ketinggian_sampah = $histori_sampah->pluck('ketinggian_sampah')->toJson();
        $volume_sampah = $histori_sampah->pluck('volume_sampah')->toJson();
        $kode_kawasan = $histori_sampah->pluck('ReferensiAlat.Kawasan.kode_kawasan')->toJson();

        return response()->json([
            'labels' => $labels,
            'ketinggian_sampah' => $ketinggian_sampah,
            'volume_sampah' => $volume_sampah,
            'kode_kawasan' => $kode_kawasan,
        ]);
    }
}
