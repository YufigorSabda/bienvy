<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GrafikSampah
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
        ->setTitle('Data Sampah per-Bulan')
        ->addData('Ketinggian', [40, 93, 35, 42, 18, 82, 50, 60, 70, 80, 90, 100]) // Contoh data ketinggian
        ->addData('Volume', [70, 29, 77, 28, 55, 45, 30, 40, 50, 60, 70, 80]) // Contoh data volume
        ->setXAxis(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'])
        ->setHeight('300');
        
        
}
}
