<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiTpa extends Model
{
    use HasFactory;

    protected $table = 'lokasi_tpa';
    protected $fillable = ['luas_tpa', 'lokasi_tpa'];

    public function kawasan()
    {
        return $this->hasMany(Kawasan::class, 'id_tpa');
    }
}
