<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Histori_sampah;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($startDate = null, $endDate = null): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Convert string dates to Carbon instances if they are not already
        $startDate = is_string($startDate) ? Carbon::parse($startDate) : $startDate;
        $endDate = is_string($endDate) ? Carbon::parse($endDate) : $endDate;

        // Default start date to the beginning of the last year and end date to the end of the last year if not provided
        $currentYear = Carbon::now()->year;
        $startDate = $startDate ?: Carbon::create($currentYear - 1, 1, 1);
        $endDate = $endDate ?: Carbon::create($currentYear - 1, 12, 31);

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
        for ($i = 1; $i <= 12; $i++) {
            $bulanLabels[] = date("F", mktime(0, 0, 0, $i, 1)); // Convert bulan number ke nama bulan
            $ketinggianData[$i] = 0;
            $volumeData[$i] = 0;
        }

        foreach ($historiSampahPerBulan as $data) {
            $ketinggianData[$data->bulan] = number_format($data->avg_ketinggian, 2, '.', '');
            $volumeData[$data->bulan] = number_format($data->avg_volume, 2, '.', '');
        }

        // Show the chart using bulan labels as X axis
        return $this->chart->barChart()
            ->setTitle("Data Sampah dari " . $startDate->format('d-m-Y') . " sampai " . $endDate->format('d-m-Y'))
            ->addData('Ketinggian', array_values($ketinggianData))
            ->addData('Volume', array_values($volumeData))
            ->setXAxis($bulanLabels)
            ->setHeight('300');
    }
}
