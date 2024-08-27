<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kawasan extends Model
{
    use HasFactory;
    protected $table = "kawasan";
    protected $primaryKey = "id_kawasan";
    public $timestamps = false;
    protected $fillable = ['luas_kawasan', 'id_tpa'];


    public function histori_kawasan()
    {
        return $this->hasMany(Histori_kawasan::class,'id_kawasan');
    }

    public function referensiAlat()
    {
        return $this->hasMany(ReferensiAlat::class, 'id_kawasan');
    }

    public function lokasiTpa()
    {
        return $this->belongsTo(LokasiTpa::class, 'id_tpa');
    }
}
