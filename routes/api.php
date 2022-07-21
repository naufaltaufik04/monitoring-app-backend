<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('dashboards/grafik/rata-rata-berat', [DashboardController::class, 'rataRataBeratPerHari']);
Route::get('dashboards/grafik/jumlah-waktu-kegiatan-hari-ini', [DashboardController::class, 'jumlahWaktuKegiatanHariIni']);
Route::get('dashboards/grafik/jumlah-waktu-kegiatan-keseluruhan', [DashboardController::class, 'jumlahWaktuKegiatanKeseluruhan']);

Route::get('dashboards/kegiatan', [KegiatanController::class, 'daftarKegiatan']);
Route::post('dashboards/kegiatan', [KegiatanController::class, 'tambahKegiatan']);
Route::put('dashboards/kegiatan/{id}', [KegiatanController::class, 'editKegiatan']);
Route::post('dashboards/kegiatan/cari', [KegiatanController::class, 'cariKegiatan']);
Route::get('dashboards/kegiatan/jenis', [JenisController::class, 'daftarJenis']);

Route::get('dashboards/rekap', [RekapController::class, 'rekapKegiatan']);
