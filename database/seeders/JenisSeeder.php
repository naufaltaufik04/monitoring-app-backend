<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < sizeof(Jenis::$JENIS_KEGIATAN); $i++) {
            Jenis::create([
                'nama' => Jenis::$JENIS_KEGIATAN[$i]
            ]);
        }
    }
}
