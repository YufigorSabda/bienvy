<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GrafikChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('San Francisco vs Boston.')
            ->setSubtitle('Wins during season 2021.')
            ->addData('San Francisco', [6, 9, 3, 4, 10, 8]) // Fix: remove space after addData
            ->addData('Boston', [7, 3, 8, 2, 6, 4]) // Fix: remove space after addData
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
