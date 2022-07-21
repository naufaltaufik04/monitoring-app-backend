<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kegiatan = array([
            'jenis' => 'Makan',
            'keterangan' => 'Sarapan',
            'durasi' => 30,
            'beratBadan' => 60,
            'tanggal' => '2020-03-01',
        ], [
            'jenis' => 'Tidur',
            'keterangan' => 'Tidur Malam',
            'durasi' => 540,
            'beratBadan' => 59.4,
            'tanggal' => '2020-03-01',
        ], [
            'jenis' => 'Aktifitas Lain',
            'keterangan' => 'Main Game',
            'durasi' => 30,
            'beratBadan' => 60,
            'tanggal' => '2020-03-01',
        ], [
            'jenis' => 'Olah Raga',
            'keterangan' => 'Lari Pagi',
            'durasi' => 30,
            'beratBadan' => 60,
            'tanggal' => '2020-03-01',
        ], [
            'jenis' => 'Makan',
            'keterangan' => 'Ngemil',
            'durasi' => 15,
            'beratBadan' => 61,
            'tanggal' => '2020-03-01',
        ], [
            'jenis' => 'Tidur',
            'keterangan' => 'Tidur Siang',
            'durasi' => 120,
            'beratBadan' => 61.2,
            'tanggal' => '2020-03-01',
        ], [
            'jenis' => 'Aktifitas Lain',
            'keterangan' => 'Ngoding',
            'durasi' => 600,
            'beratBadan' => 61.4,
            'tanggal' => '2020-03-02',
        ], [
            'jenis' => 'Olah Raga',
            'keterangan' => 'Lari Pagi',
            'durasi' => 60,
            'beratBadan' => 62,
            'tanggal' => '2020-03-02',
        ], [
            'jenis' => 'Makan',
            'keterangan' => 'Sarapan',
            'durasi' => 60,
            'beratBadan' => 60,
            'tanggal' => '2020-03-02',
        ], [
            'jenis' => 'Tidur',
            'keterangan' => '',
            'durasi' => 32,
            'beratBadan' => 61,
            'tanggal' => '2020-03-02',
        ]);

        foreach ($kegiatan as $jenisKegiatan) {
            $jenis = array_keys(Jenis::$JENIS_KEGIATAN, $jenisKegiatan['jenis']);
            Kegiatan::create([
                'id_jenis' => $jenis[0] + 1,
                'keterangan' => $jenisKegiatan['keterangan'],
                'durasi' => $jenisKegiatan['durasi'],
                'berat_badan' => $jenisKegiatan['beratBadan'],
                'tanggal' => date_create($jenisKegiatan['tanggal']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
