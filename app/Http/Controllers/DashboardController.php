<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Kegiatan;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function rataRataBeratPerHari()
    {
        $daftarBerat = Kegiatan::select(
            DB::raw('date(tanggal) as tanggal'),
            DB::raw('avg(berat_badan) as berat')
        )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        if (count($daftarBerat) === 0) {
            return response()->json([
                'status'    => false,
                'pesan'     => 'Tidak ada data',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'pesan' => 'Berhasil mendapatkan hasil rata rata berat badan per hari',
            'data' => $daftarBerat
        ], Response::HTTP_OK);
    }

    public function jumlahWaktuKegiatanHariIni()
    {
        $now = new DateTime("now", new DateTimeZone('Asia/Jakarta'));

        $jumlahWaktu = Jenis::select('nama', DB::raw('sum(durasi) as jumlah'))
            ->join('kegiatan', 'jenis.id', '=', 'kegiatan.id_jenis')
            ->where('tanggal', $now->format('Y-m-d'))
            ->groupBy('nama')
            ->get();



        return response()->json([
            'status' => true,
            'pesan' => 'Berhasil mendapatkan hasil rata rata berat badan per hari',
            'data' => $jumlahWaktu
        ], Response::HTTP_OK);
    }

    public function jumlahWaktuKegiatanKeseluruhan()
    {
        $jumlahWaktu = Jenis::select('nama', DB::raw('sum(durasi) as jumlah'))
            ->join('kegiatan', 'jenis.id', '=', 'kegiatan.id_jenis')
            ->groupBy('nama')
            ->get();

        if (count($jumlahWaktu) === 0) {
            return response()->json([
                'status'    => false,
                'pesan'     => 'Tidak ada data',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'pesan' => 'Berhasil mendapatkan hasil rata rata berat badan per hari',
            'data' => $jumlahWaktu
        ], Response::HTTP_OK);
    }
}
