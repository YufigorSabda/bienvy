<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori_sampah extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'histori_sampahs';
    
    protected $fillable = ['ketinggian_sampah', 'waktu', 'volume', 'id_alat', 'keterangan'];

    protected $primaryKey = 'id';

    public function referensiAlat()
    {
        return $this->belongsTo(ReferensiAlat::class, 'id_alat');
    }

}
