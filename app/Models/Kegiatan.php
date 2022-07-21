<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = "kegiatan";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'id_jenis',
        'keterangan',
        'durasi',
        'berat_badan',
        'tanggal',
        'created_at',
        'update_at'
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis');
    }
}
