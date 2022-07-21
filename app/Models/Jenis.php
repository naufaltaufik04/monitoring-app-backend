<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = "jenis";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama'
    ];

    public static $JENIS_KEGIATAN = ["Makan", "Tidur", "Olah Raga", "Aktifitas Lain"];

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'id_jenis');
    }
}
