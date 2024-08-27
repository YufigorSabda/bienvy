<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IotData;

class IotDataController extends Controller
{
    public function store(Request $request)
    {
        $sensor_id = $_GET['sensor_id'];
        $temperature = $_GET['temperature'];
        $humidity = $_GET['humidity'];

        try {
            DB::table('iot_data')
            ->insert([
                'sensor_id' => $sensor_id,
                'temperature' => $temperature,
                'humidity' => $humidity,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json(['message' => 'Data telah diterima dan disimpan']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal disimpan']);
        }
        
    }
}
