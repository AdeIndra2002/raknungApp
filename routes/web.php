<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about')->middleware(['role:admin|staff']);

    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware(['role:admin|pimpinan']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['role:admin|pimpinan']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['role:admin|pimpinan']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware(['role:admin|pimpinan']);

    Route::resource('divisi', DivisiController::class)->middleware(['role:admin']);
    Route::resource('barang', BarangController::class)->middleware(['role:admin']);
    Route::resource('kategori', KategoriController::class)->middleware(['role:admin']);
    Route::resource('supplier', SupplierController::class)->middleware(['role:admin']);

    Route::resource('pengajuan', PengajuanController::class)->middleware(['role:admin|pimpinan|staff']);
    Route::patch('pengajuan/{pengajuan}/verif', [PengajuanController::class, 'verify'])->name('pengajuan.verif');
    Route::patch('pengajuan/{pengajuan}/rejected', [PengajuanController::class, 'rejected'])->name('pengajuan.rejected');
    Route::get('/pengajuan/{id}/generate', [PengajuanController::class, 'generate'])->name('pengajuan.generate');
    Route::get('/laporanPengajuan', [PengajuanController::class, 'cetakPengajuan'])->name('pengajuan.laporan');
    Route::get('/laporanStatus', [PengajuanController::class, 'cetakStatus'])->name('pengajuan.status');
    Route::get('/laporanWaktu', [PengajuanController::class, 'cetakWaktu'])->name('pengajuan.waktu');

    Route::resource('pembelian', PembelianController::class)->middleware(['role:admin|pimpinan|staff']);
    Route::get('/pembelians/{id}/hapus-gambar', [GambarController::class, 'index'])->name('pembelians.hapusGambar');
    Route::delete('/gambar/{id}', [GambarController::class, 'destroy'])->name('gambar.destroy');
    Route::patch('pembelian/{pembelian}/verif', [PembelianController::class, 'verify'])->name('pembelian.verif');
    Route::patch('pembelian/{pembelian}/rejected', [PembelianController::class, 'rejected'])->name('pembelian.rejected');
    Route::get('/pembelian/{id}/generate', [PembelianController::class, 'generate'])->name('pembelian.generate');
    Route::get('/laporanPembelian', [PembelianController::class, 'cetakPembelian'])->name('pembelian.laporan');
    Route::get('/laporanStatusPembelian', [PembelianController::class, 'cetakStatus'])->name('pembelian.status');
    Route::get('/laporanWaktuPembelian', [PembelianController::class, 'cetakWaktu'])->name('pembelian.waktu');

    Route::resource('penerimaan', PenerimaanController::class)->middleware(['role:admin|pimpinan|staff']);
    Route::get('/penerimaan/{id}/generate', [PenerimaanController::class, 'generate'])->name('penerimaan.generate');
    Route::get('/cetakSemu', [PenerimaanController::class, 'cetakSemu'])->name('penerimaan.cetakSemu');



    Route::get('/markAsRead', [DashboardController::class, 'markAsRead'])->name('markAsRead');
});


require __DIR__ . '/auth.php';
