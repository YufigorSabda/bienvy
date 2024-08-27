<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori_kualitas extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function parameter_kualitas_udara()
    {
        return $this->belongsTo(Parameter_kualitas_udara::class, 'id_parameter');
    }

    

    public function alat()
    {
        return $this->belongsTo(referensi_alat::class, 'id_alat');
    }

}
