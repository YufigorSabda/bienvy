<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parameter_kualitas_udara extends Model
{
    use HasFactory;

    protected $table = "parameter_kualitas_udara";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_parameter', 'batas_parameter_atas', 'batas_parameter_bawah', 'satuan'
    ];

    public function historiKualitas()
    {
        return $this->hasMany(Histori_kualitas::class);
    }
}
