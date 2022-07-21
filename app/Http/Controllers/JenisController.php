<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Response;

class JenisController extends Controller
{
    public function daftarJenis()
    {
        $kegiatan = Jenis::select('id', 'nama')->get();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan daftar kegiatan',
            'data' => $kegiatan
        ], Response::HTTP_OK);
    }
}
