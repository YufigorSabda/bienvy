<?php

namespace App\Http\Controllers;

use App\Charts\Parameter2;
use App\Models\Histori_sampah;
use Illuminate\Http\Request;
use App\Charts\BarChart;
use App\Charts\GrafikChart;
use App\Charts\GrafikSampah;
use App\Charts\SampahChart;
use App\Charts\Parameter1;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    
    
    public function index(Parameter1 $parameter1, Parameter2 $parameter2)
    {
        $rata_rata_parameter = $parameter1->build();
        
        $histori_sampah = Histori_sampah::all();
        $rata_rata_volume = Histori_sampah::whereYear('waktu', '=', date('Y'))
        ->avg('volume');

        $rata_rata_volume = number_format($rata_rata_volume, 2);

        $rata_rata_ketinggian = Histori_sampah::whereYear('waktu', '=', date('Y'))
        ->avg('ketinggian_sampah');
        $rata_rata_ketinggian = number_format($rata_rata_ketinggian, 2);

        $rata_rata_volume2 = Histori_sampah::whereYear('waktu', '=', Carbon::now()->subYear()->year)
        ->avg('volume');
        $rata_rata_ketinggian2 = Histori_sampah::whereYear('waktu', '=', Carbon::now()->subYear()->year)
        ->avg('ketinggian_sampah');
        
        if ($rata_rata_volume2 != 0) {
            $selisih_volume = (($rata_rata_volume - $rata_rata_volume2) / $rata_rata_volume2) * 100;
        } else {
            $selisih_volume = null; // or some appropriate value
        }

        if ($rata_rata_ketinggian2 != 0) {
            $selisih_ketinggian = (($rata_rata_ketinggian - $rata_rata_ketinggian2) / $rata_rata_ketinggian2) * 100;
        } else {
            $selisih_ketinggian = null; // or some appropriate value
        }


        return view('monitoring.index',[
            'rata_rata_volume' => $rata_rata_volume,
            'rata_rata_ketinggian' => $rata_rata_ketinggian,
            'rata_rata_parameter' => $rata_rata_parameter,
            'selisih_volume'=>$selisih_volume,
            'selisih_ketinggian'=>$selisih_ketinggian,
            'parameter2' => $parameter2->build()
        ]);
    }
    
}