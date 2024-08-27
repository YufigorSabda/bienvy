<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Histori_kualitas;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ChartParameter4
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($startDate = null, $endDate = null): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $startDate = is_string($startDate) ? Carbon::parse($startDate) : Carbon::now()->startOfYear();
        $endDate = is_string($endDate) ? Carbon::parse($endDate) : Carbon::now()->endOfYear();

        // Default start date to the beginning of the year and end date to the current date if not provided
        $startDate = $startDate ?: Carbon::now()->startOfYear();
        $endDate = $endDate ?: Carbon::now();

        // Query to fetch the average value of the parameter grouped by month for the specified year
        $historiKualitas = Histori_kualitas::select(
            DB::raw("MONTH(waktu) as bulan"),
            DB::raw("YEAR(waktu) as tahun"),
            DB::raw("AVG(nilai_parameter) as rata_rata_parameter")
        )
        ->whereBetween('waktu', [$startDate, $endDate])
        ->where('id_parameter', 4) // Only for a specific parameter id
        ->groupBy(DB::raw("YEAR(waktu), MONTH(waktu)"))
        ->orderBy(DB::raw("YEAR(waktu), MONTH(waktu)"))
        ->get();

        $bulanLabels = [];
        $rataRataParameter = [];

        for ($date = $startDate->copy(); $date->lessThanOrEqualTo($endDate); $date->addMonth()) {
            $label = ucfirst($date->translatedFormat('F Y'));
            $bulanLabels[] = $label;
            $rataRataParameter[$label] = 0;
        }

        foreach ($historiKualitas as $data) {
            $label = ucfirst(Carbon::create($data->tahun, $data->bulan, 1)->translatedFormat('F Y'));
            $rataRataParameter[$label] = round($data->rata_rata_parameter, 2); // Use round function to ensure 2 decimal places
        }

        $finalLabels = array_keys($rataRataParameter);
        $finalValues = array_values($rataRataParameter);

        return $this->chart->lineChart()
            ->setTitle('Parameter NO2')
            ->setSubtitle("Rata-rata nilai parameter dari " . $startDate->format('d-m-Y') . " sampai " . $endDate->format('d-m-Y'))
            ->addData('Average Value', $finalValues)
            ->setXAxis($finalLabels)
            ->setHeight(300)
            ->setColors(['#800080']);
        }
}
