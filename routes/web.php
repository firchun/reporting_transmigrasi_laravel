<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Bidang;
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

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //akun managemen
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //customers managemen
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers/store',  [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/edit/{id}',  [CustomerController::class, 'edit'])->name('customers.edit');
    Route::delete('/customers/delete/{id}',  [CustomerController::class, 'destroy'])->name('customers.delete');
    Route::get('/customers-datatable', [CustomerController::class, 'getCustomersDataTable']);
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
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
});
