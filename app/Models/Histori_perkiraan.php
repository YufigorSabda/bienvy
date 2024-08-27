<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori_perkiraan extends Model
{
    use HasFactory;
    protected $table = 'histori_perkiraan';
    public $timestamps = false;

    public function parameter_kualitas_udara()
    {
        return $this->belongsTo(Parameter_kualitas_udara::class, 'id_parameter');
    }
}
