<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SolutionsController;
use App\Http\Controllers\Admin\SiskaController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\TempatController;
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

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/solutions', [SolutionsController::class, 'index'])->name('solutions');
    Route::get('/siska', [SiskaController::class, 'index'])->name('siska');
    Route::resource('lokasi', TempatController::class);
    // Route::resource('lokasi', \App\Http\Controllers\LokasiController::class);
    // Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');
    // Route::get('/lokasi/edit', [LokasiController::class, 'edit'])->name('lokasi.edit');
    // Route::get('/lokasi/tambah', [LokasiController::class, 'tambah'])->name('lokasi.tambah');
    // Route::get('/lokasi/delete', [LokasiController::class, 'delete'])->name('lokasi.delete');
});
