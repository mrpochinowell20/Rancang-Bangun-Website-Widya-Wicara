<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SolutionsController;
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

Route::prefix('admin')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get("/solutions", [SolutionsController::class, 'index'])->name('solutions');
});