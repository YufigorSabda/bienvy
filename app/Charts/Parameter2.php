<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Histori_sampah;
use Illuminate\Support\Facades\DB;

class Parameter2
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Mendapatkan tanggal awal tahun terakhir (1 Januari)
        $startDate = now()->startOfYear();
        // Mendapatkan tanggal akhir tahun terakhir (31 Desember)
        $endDate = now()->endOfYear();

        // Query histori sampah data based on the selected date range
        $historiSampahPerBulan = Histori_sampah::select(
            DB::raw('MONTH(waktu) as bulan'),
            DB::raw('AVG(ketinggian_sampah) as avg_ketinggian'),
            DB::raw('AVG(volume) as avg_volume')
        )
        ->whereBetween('waktu', [$startDate, $endDate])
        ->groupBy(DB::raw("MONTH(waktu)"))
        ->orderBy(DB::raw("MONTH(waktu)"))
        ->get();

        // Prepare data for the chart
        $bulanLabels = [];
        $ketinggianData = [];
        $volumeData = [];

        // Fill data from database into the prepared arrays
        foreach ($historiSampahPerBulan as $data) {
            $bulanLabels[] = date("F", mktime(0, 0, 0, $data->bulan, 1)); // Convert bulan number ke nama bulan
            $ketinggianData[] = number_format($data->avg_ketinggian, 2, '.', '');
            $volumeData[] = number_format($data->avg_volume, 2, '.', '');
        }

        return $this->chart->barChart()
            ->setTitle("Nilai Rata-Rata Sampah Pada Tahun" . $startDate->format(' Y'))
            ->addData('Ketinggian', $ketinggianData)
            ->addData('Volume', $volumeData)
            ->setXAxis($bulanLabels) // Gunakan nama bulan sebagai label sumbu X
            ->setHeight('345');
    }

}
