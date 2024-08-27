app/Models/Kawasan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kawasan extends Model
{
    use HasFactory;

    protected $table = 'kawasan';

    protected $fillable = ['luas_kawasan', 'id_tpa'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_kawasan', 'id_kawasan');
    }
}
