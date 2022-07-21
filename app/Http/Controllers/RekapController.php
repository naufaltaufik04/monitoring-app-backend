<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function rekapKegiatan()
    {
        $daftarKegiatan = Kegiatan::select(
            DB::raw('date(tanggal) as tanggal'),
            'nama',
            DB::raw('sum(durasi) as durasi')
        )
            ->join('jenis', 'jenis.id', '=', 'kegiatan.id_jenis')
            ->groupBy('tanggal', 'nama')
            ->orderBy('tanggal', 'ASC')
            ->get();

        if (count($daftarKegiatan) === 0) {
            return response()->json([
                'status'    => false,
                'pesan'     => 'Tidak ada data',
            ], Response::HTTP_OK);
        }

        $tempTanggal = $daftarKegiatan[0]->tanggal;
        $jumlah = 0;

        foreach ($daftarKegiatan as $data) {
            if ($tempTanggal != $data->tanggal) {
                $rekapKegiatan[] = [
                    'tanggal' => $tempTanggal,
                    'daftarKegiatan' => isset($kegiatan) ? $kegiatan : null,
                    'jumlah' => $jumlah / 60
                ];
                $tempTanggal = $data->tanggal;
                $jumlah = 0;
                unset($kegiatan);
            }
            $kegiatan[] = [
                'nama' => $data->nama,
                'durasi' => $data->durasi / 60
            ];
            $jumlah += $data->durasi;

            (!isset($total[$data->nama])) ?
                $total[$data->nama] = $data->durasi / 60 : $total[$data->nama] += $data->durasi / 60;
        }

        return response()->json([
            'status' => true,
            'pesan' => 'Berhasil mendapatkan rekap kegiatan',
            'data' => [
                'rekap' => $rekapKegiatan,
                'total' => $total
            ]
        ], Response::HTTP_OK);
    }
}
