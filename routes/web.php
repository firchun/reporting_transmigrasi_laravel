<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LowonganKerjaController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenagaAsingController;
use App\Http\Controllers\TenagaLokalController;
use App\Http\Controllers\UserController;
use App\Models\Bidang;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
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


Auth::routes(['verify' => true]);
Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('/grafik', [App\Http\Controllers\HomeController::class, 'grafik'])->name('grafik');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //akun managemen
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //loker managemen
    Route::get('/lowongan-kerja/detail/{id}', [LowonganKerjaController::class, 'detail'])->name('lowongan-kerja.detail');
    //customers managemen
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers/store',  [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/edit/{id}',  [CustomerController::class, 'edit'])->name('customers.edit');
    Route::delete('/customers/delete/{id}',  [CustomerController::class, 'destroy'])->name('customers.delete');
    Route::get('/customers-datatable', [CustomerController::class, 'getCustomersDataTable']);
});
Route::middleware(['auth:web', 'role:Perusahaan'])->group(function () {
    //perusahaan management
    Route::post('/perusahaan/store',  [PerusahaanController::class, 'store'])->name('perusahaan.store');
    Route::get('/perusahaan/perusahaan',  [PerusahaanController::class, 'perusahaan'])->name('perusahaan.perusahaan');
    //tka management
    Route::get('/lowongan-kerja', [LowonganKerjaController::class, 'index'])->name('lowongan-kerja');
    Route::post('/lowongan-kerja/store',  [LowonganKerjaController::class, 'store'])->name('lowongan-kerja.store');
    Route::get('/lowongan-kerja/edit/{id}',  [LowonganKerjaController::class, 'edit'])->name('lowongan-kerja.edit');
    Route::delete('/lowongan-kerja/delete/{id}',  [LowonganKerjaController::class, 'destroy'])->name('lowongan-kerja.delete');
    Route::get('/lowongan-kerja-datatable/{id_perusahaan}', [LowonganKerjaController::class, 'getLowonganKerjaDataTable']);
    //tka management
    Route::get('/tka', [TenagaAsingController::class, 'index'])->name('tka');
    Route::post('/tka/store',  [TenagaAsingController::class, 'store'])->name('tka.store');
    Route::get('/tka/edit/{id}',  [TenagaAsingController::class, 'edit'])->name('tka.edit');
    Route::delete('/tka/delete/{id}',  [TenagaAsingController::class, 'destroy'])->name('tka.delete');
    Route::get('/tka-datatable/{id_perusahaan}', [TenagaAsingController::class, 'gettkaDataTable']);
    //tkl management
    Route::get('/tkl', [TenagaLokalController::class, 'index'])->name('tkl');
    Route::post('/tkl/store',  [TenagaLokalController::class, 'store'])->name('tkl.store');
    Route::get('/tkl/edit/{id}',  [TenagaLokalController::class, 'edit'])->name('tkl.edit');
    Route::delete('/tkl/delete/{id}',  [TenagaLokalController::class, 'destroy'])->name('tkl.delete');
    Route::get('/tkl-datatable/{id_perusahaan}', [TenagaLokalController::class, 'gettklDataTable']);
    //laporan management
    Route::get('/laporan/perusahaan/tkl', [LaporanController::class, 'perusahaan_tkl'])->name('laporan.perusahaan.tkl');
    Route::get('/laporan/perusahaan/tka', [LaporanController::class, 'perusahaan_tka'])->name('laporan.perusahaan.tka');
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
    //bidang
    Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan');
    Route::get('/perusahaan/aktifkan/{id}', [PerusahaanController::class, 'aktifkan'])->name('perusahaan.aktifkan');
    Route::get('/perusahaan/non-aktifkan/{id}', [PerusahaanController::class, 'non_aktifkan'])->name('perusahaan.non-aktifkan');

    //bidang
    Route::get('/bidang', [BidangController::class, 'index'])->name('bidang');
    Route::post('/bidang/store',  [BidangController::class, 'store'])->name('bidang.store');
    Route::get('/bidang/edit/{id}',  [BidangController::class, 'edit'])->name('bidang.edit');
    Route::delete('/bidang/delete/{id}',  [BidangController::class, 'destroy'])->name('bidang.delete');
    Route::get('/bidang-datatable', [BidangController::class, 'getBidangDataTable']);
    //pendidikan
    Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan');
    Route::post('/pendidikan/store',  [PendidikanController::class, 'store'])->name('pendidikan.store');
    Route::get('/pendidikan/edit/{id}',  [PendidikanController::class, 'edit'])->name('pendidikan.edit');
    Route::delete('/pendidikan/delete/{id}',  [PendidikanController::class, 'destroy'])->name('pendidikan.delete');
    Route::get('/pendidikan-datatable', [PendidikanController::class, 'getPendidikanDataTable']);
    //user managemen
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/admin', [UserController::class, 'admin'])->name('users.admin');
    Route::get('/users/kepala-bidang', [UserController::class, 'kepalaBidang'])->name('users.kepala-bidang');
    Route::get('/users/perusahaan', [UserController::class, 'perusahaan'])->name('users.perusahaan');
    Route::post('/users/store',  [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',  [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/delete/{id}',  [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users-datatable/{role}', [UserController::class, 'getUsersDataTable']);
    //perusahaan
    // Route::get('/perusahaan-datatable', [PerusahaanController::class, 'getPerusahaanDataTable']);
    //tka
    // Route::get('/all-tka-datatable', [TenagaAsingController::class, 'getalltkaDataTable']);
    // //tkl
    // Route::get('/all-tkl-datatable', [TenagaLokalController::class, 'getalltklDataTable']);
    //laporan
    // Route::get('/laporan/admin/perusahaan', [LaporanController::class, 'all_perusahaan'])->name('laporan.admin.perusahaan');
    // Route::get('/laporan/admin/tkl', [LaporanController::class, 'all_tkl'])->name('laporan.admin.tkl');
    // Route::get('/laporan/admin/tka', [LaporanController::class, 'all_tka'])->name('laporan.admin.tka');
    // Route::get('/laporan/admin/lowongan-kerja', [LaporanController::class, 'all_lowongan_kerja'])->name('laporan.admin.lowongan-kerja');
});
Route::middleware(['auth:web', 'role:Admin,Bidang'])->group(function () {
    //perusahaan
    Route::get('/all-lowongan-kerja-datatable', [LowonganKerjaController::class, 'getAllLowonganKerjaDataTable']);
    //perusahaan
    Route::get('/perusahaan-datatable', [PerusahaanController::class, 'getPerusahaanDataTable']);
    //tka
    Route::get('/all-tka-datatable', [TenagaAsingController::class, 'getalltkaDataTable']);
    //tkl
    Route::get('/all-tkl-datatable', [TenagaLokalController::class, 'getalltklDataTable']);
    //laporan
    Route::get('/laporan/admin/perusahaan', [LaporanController::class, 'all_perusahaan'])->name('laporan.admin.perusahaan');
    Route::get('/laporan/admin/tkl', [LaporanController::class, 'all_tkl'])->name('laporan.admin.tkl');
    Route::get('/laporan/admin/tka', [LaporanController::class, 'all_tka'])->name('laporan.admin.tka');
    Route::get('/laporan/admin/lowongan-kerja', [LaporanController::class, 'all_lowongan_kerja'])->name('laporan.admin.lowongan-kerja');
});