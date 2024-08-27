<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiAlat extends Model
{
    use HasFactory;
    protected $table = "referensi_alat";
    protected $primaryKey = "id_alat";
    public $timestamps = false;

    protected $fillable = ['alat', 'kode_alat', 'id_kawasan'];

    public function udara()
    {
        return $this->hasMany(Histori_kualitas::class);
    }

    public function kawasan()
    {
        return $this->belongsTo(Kawasan::class,'id_kawasan');
    }

    public function historiSampahs()
    {
        return $this->hasMany(Histori_sampah::class, 'id_alat');
    }
}
