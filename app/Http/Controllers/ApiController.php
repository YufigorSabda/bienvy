<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function update_table() {
        $histori_sampah = DB::table('histori_sampah')->get();

        $waktu = $histori_sampah->pluck('waktu');
        $ketinggian = $histori_sampah->pluck('ketinggian');
        $volume = $histori_sampah->pluck('volume');

        return response()->json([
            "waktu" => $waktu,
            "ketinggian" => $ketinggian,
            "volume" => $volume
        ]);
    }
}
