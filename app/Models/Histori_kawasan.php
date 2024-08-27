<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori_kawasan extends Model
{
    use HasFactory;

    protected $table = 'histori_kawasan';
    protected $primaryKey = 'id';
    
    protected $fillable =['id_kawasan','status','waktu'];

    public $timestamps = false;


    public function kawasan()
    {
        return $this->belongsTo(Kawasan::class, 'id_kawasan');
    }
}
