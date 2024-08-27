<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Histori_perkiraan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class Dashboard2
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {   
        App::setLocale('id_ID');

        $startDate = Carbon::now(); // Start from today
        $endDate = Carbon::now()->addDays(7); // Up to 7 days from now

        // Query to fetch the average value of each parameter for each day for id_alat 1
        $historiperkiraan = Histori_perkiraan::select(
            DB::raw("DATE(waktu) as tanggal"),
            DB::raw("AVG(CASE WHEN id_parameter = 1 THEN nilai_parameter ELSE NULL END) AS pm25"),
            DB::raw("AVG(CASE WHEN id_parameter = 2 THEN nilai_parameter ELSE NULL END) AS pm10"),
            DB::raw("AVG(CASE WHEN id_parameter = 3 THEN nilai_parameter ELSE NULL END) AS so2"),
            DB::raw("AVG(CASE WHEN id_parameter = 4 THEN nilai_parameter ELSE NULL END) AS no2"),
            DB::raw("AVG(CASE WHEN id_parameter = 5 THEN nilai_parameter ELSE NULL END) AS co"),
            DB::raw("AVG(CASE WHEN id_parameter = 6 THEN nilai_parameter ELSE NULL END) AS o3")
        )
            ->where('id_alat', 2)
            ->whereBetween('waktu', [$startDate, $endDate])
            ->groupBy(DB::raw("DATE(waktu)"))
            ->orderBy(DB::raw("DATE(waktu)"))
            ->get();

        $tanggalLabels = [];
        $pm25Data = [];
        $pm10Data = [];
        $so2Data = [];
        $no2Data = [];
        $coData = [];
        $o3Data = [];

        for ($i = 0; $i <= 7; $i++) {
            $currentDate = Carbon::now()->addDays($i);
            $tanggalLabel = $currentDate->locale('id')->translatedFormat('l');
            $tanggalLabels[] = $tanggalLabel;

            $pm25Value = 0;
            $pm10Value = 0;
            $so2Value = 0;
            $no2Value = 0;
            $coValue = 0;
            $o3Value = 0;

            foreach ($historiperkiraan as $data) {
                if (date("Y-m-d", strtotime($data->tanggal)) == date("Y-m-d", strtotime(Carbon::now()->addDays($i)))) {
                    $pm25Value = round($data->pm25, 2);
                    $pm10Value = round($data->pm10, 2);
                    $so2Value = round($data->so2, 2);
                    $no2Value = round($data->no2, 2);
                    $coValue = round($data->co, 2);
                    $o3Value = round($data->o3, 2);
                }
            }

            $pm25Data[] = $pm25Value;
            $pm10Data[] = $pm10Value;
            $so2Data[] = $so2Value;
            $no2Data[] = $no2Value;
            $coData[] = $coValue;
            $o3Data[] = $o3Value;
        }

        return $this->chart->lineChart()
            ->setTitle('Perkiraan Kawasan B')
            ->setSubtitle("Perkiraan Rata - Rata Kualitas Udara dari " . $startDate->locale('id')->translatedFormat('l').','.$startDate->format('d-m-Y')  . " sampai " . $endDate->locale('id')->translatedFormat('l','d-m-Y').','.$endDate->format('d-m-Y'))
            ->addData('PM2.5', $pm25Data)
            ->addData('PM10', $pm10Data)
            ->addData('SO2', $so2Data)
            ->addData('NO2', $no2Data)
            ->addData('CO', $coData)
            ->addData('O3', $o3Data)
            ->setXAxis($tanggalLabels)
            ->setHeight(300)
            ->setWidth(900);
    }
}