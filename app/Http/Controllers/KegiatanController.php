<?php

namespace App\Http\Controllers;

use App\Http\Requests\CariKegiatanRequest;
use App\Http\Requests\EditKegiatanRequest;
use App\Http\Requests\TambahKegiatanRequest;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Response;

class KegiatanController extends Controller
{
    public function daftarKegiatan()
    {
        $daftarKegiatan = Kegiatan::select('id', 'tanggal', 'durasi', 'keterangan', 'berat_badan', 'id_jenis')
            ->with('jenis:id,nama')
            ->orderBy('tanggal', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(env('SIZE_PAGE'));

        if (count($daftarKegiatan) === 0) {
            return response()->json([
                'status'    => false,
                'pesan'     => 'Tidak ada data',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status'    => true,
            'pesan'     => 'Berhasil mendapatkan daftar kegiatan',
            'data'      => $daftarKegiatan
        ], Response::HTTP_OK);
    }

    public function tambahKegiatan(TambahKegiatanRequest $request)
    {
        $validate = $request->validated();

        $kegiatan = Kegiatan::create([
            'id_jenis'      => $validate['id_jenis'],
            'keterangan'    => $validate['keterangan'],
            'durasi'        => $validate['durasi'],
            'berat_badan'   => $validate['berat_badan'],
            'tanggal'       => date_create($validate['tanggal']),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        return response()->json([
            'status' => true,
            'pesan' => 'Berhasil menambahkan kegiatan',
            'data' => $kegiatan
        ], Response::HTTP_OK);
    }

    public function editKegiatan(EditKegiatanRequest $request, $id)
    {
        $validate = $request->validated();

        Kegiatan::where('id', $id)->update($request->all());

        return response()->json([
            'status' => true,
            'pesan' => 'Berhasil memperbaharui kegiatan',
            'data' => $request
        ], Response::HTTP_OK);
    }

    public function cariKegiatan(CariKegiatanRequest $request)
    {
        $validate = $request->validated();

        $jenis = $validate['id_jenis'];
        $durasi = $validate['durasi'];
        $date = [
            'from' => $validate['from'],
            'to' => $validate['to']
        ];

        $daftarKegiatan = Kegiatan::select('id', 'tanggal', 'durasi', 'keterangan', 'berat_badan', 'id_jenis')
            ->with('jenis:id,nama')
            ->when($jenis, function ($query, $jenis) {
                return $query->where('id_jenis', $jenis);
            })
            ->when($durasi, function ($query, $durasi) {
                return $query->where('durasi', '>=', $durasi);
            })
            ->when($date, function ($query, $date) {
                if ($date['from'] != null) {
                    if ($date['to'] != null) {
                        return $query->whereBetween(
                            'tanggal',
                            [date_create($date['from']), date_create($date['to'])]
                        );
                    }
                    return $query->whereDate('tanggal', '>=', date_create($date['from']));
                } else if ($date['to'] != null) {
                    return $query->whereDate('tanggal', '<=', date_create($date['to']));
                }
            })
            ->orderBy('tanggal', 'DESC')
            ->paginate(env('SIZE_PAGE'));

        if (count($daftarKegiatan) === 0) {
            return response()->json([
                'status'    => false,
                'pesan'     => 'Tidak ada data',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'pesan' => 'Berhasil mendapatkan daftar kegiatan yang dicari',
            'data' => $daftarKegiatan
        ], Response::HTTP_OK);
    }
}
