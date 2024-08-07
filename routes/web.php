<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KategoriController;
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

    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware(['role:admin']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['role:admin']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['role:admin']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware(['role:admin']);

    Route::resource('divisi', DivisiController::class)->middleware(['role:admin']);
    Route::resource('barang', BarangController::class)->middleware(['role:admin']);
    Route::resource('kategori', KategoriController::class)->middleware(['role:admin']);
    Route::resource('supplier', SupplierController::class)->middleware(['role:admin']);

    Route::resource('pengajuan', PengajuanController::class)->middleware(['role:admin|pimpinan|staff']);
    Route::patch('pengajuan/{pengajuan}/verif', [PengajuanController::class, 'verify'])->name('pengajuan.verif');
    Route::get('/markAsRead', [DashboardController::class, 'markAsRead'])->name('markAsRead');
});


require __DIR__ . '/auth.php';
