<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\Dashboard1;
use App\Charts\Dashboard2;
use App\Charts\Dashboard3;
use App\Charts\Dashboard4;
use App\Charts\Dashboard5;
use App\Charts\Status_kawasan;
use App\Models\Histori_kawasan;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function index(Dashboard1 $dashboard1, Dashboard2 $dashboard2, Dashboard3 $dashboard3, Dashboard4 $dashboard4, Dashboard5 $dashboard5)
    {
        $statusKawasan = $this->set_status_kawasan();
        

        // Kemudian, lewatkan data dashboard dan data kawasan ke view
        return view('dashboard.index', [
            'dashboard1' => $dashboard1->build(),
            'dashboard2' => $dashboard2->build(),
            'dashboard3' => $dashboard3->build(),
            'dashboard4' => $dashboard4->build(),
            'dashboard5' => $dashboard5->build(),
            'statusKawasan' => $statusKawasan,
        ]);
    }

    public function set_status_kawasan()
    {
        // Ambil data histori_kawasan terbaru untuk setiap id_kawasan
        $statusKawasan = Histori_kawasan::select('histori_kawasan.*')
        ->join(DB::raw('(SELECT id_kawasan, MAX(waktu) AS max_waktu FROM histori_kawasan GROUP BY id_kawasan) as latest'), function ($join) {
            $join->on('histori_kawasan.id_kawasan', '=', 'latest.id_kawasan')
                 ->on('histori_kawasan.waktu', '=', 'latest.max_waktu');
        })
        ->with('kawasan')
        ->orderBy('histori_kawasan.id_kawasan')
        ->get()
        ->groupBy('kawasan.id_kawasan');

    return $statusKawasan;


    }
    


}
