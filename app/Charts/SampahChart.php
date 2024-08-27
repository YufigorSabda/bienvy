<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Histori_sampah;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class SampahChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($startDate = null, $endDate = null): \ArielMejiaDev\LarapexCharts\BarChart
    {
        App::setLocale('id_ID');

        // Convert string dates to Carbon instances if they are not already
        $startDate = is_string($startDate) ? Carbon::parse($startDate) : $startDate;
        $endDate = is_string($endDate) ? Carbon::parse($endDate) : $endDate;

        // Default start date to the beginning of the year and end date to the current date if not provided
        $startDate = $startDate ?: Carbon::now()->startOfYear();
        $endDate = $endDate ?: Carbon::now();

        // Query histori sampah data based on the selected date range
        $historiSampahPerBulan = Histori_sampah::select(
            DB::raw('YEAR(waktu) as tahun'),
            DB::raw('MONTH(waktu) as bulan'),
            DB::raw('AVG(ketinggian_sampah) as avg_ketinggian'),
            DB::raw('AVG(volume) as avg_volume')
        )
            ->whereBetween('waktu', [$startDate, $endDate])
            ->groupBy(DB::raw("YEAR(waktu), MONTH(waktu)"))
            ->orderBy(DB::raw("YEAR(waktu), MONTH(waktu)"))
            ->get();

        // Prepare data for the chart
        $bulanLabels = [];
        $ketinggianData = [];
        $volumeData = [];

        // Generate labels and initialize data arrays based on the selected date range
        for ($date = $startDate->copy(); $date->lessThanOrEqualTo($endDate); $date->addMonth()) {
            $label = ucfirst($date->translatedFormat('F Y'));
            $bulanLabels[] = $label;
            $ketinggianData[$label] = 0;
            $volumeData[$label] = 0;
        }

        // Fill the data arrays with actual data
        foreach ($historiSampahPerBulan as $data) {
            $label = ucfirst(Carbon::create($data->tahun, $data->bulan)->translatedFormat('F Y'));
            $ketinggianData[$label] = number_format($data->avg_ketinggian, 2, '.', '');
            $volumeData[$label] = number_format($data->avg_volume, 2, '.', '');
        }

        // Show the chart using bulan labels as X axis
        return $this->chart->barChart()
            ->setTitle("Data Sampah dari " . $startDate->translatedFormat('d F Y') . " sampai " . $endDate->translatedFormat('d F Y'))
            ->addData('Ketinggian', array_values($ketinggianData))
            ->addData('Volume', array_values($volumeData))
            ->setXAxis($bulanLabels)
            ->setHeight(300);
    }
}
