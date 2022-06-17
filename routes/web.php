<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SolutionController;
use App\Http\Controllers\Admin\MedsosController;
use App\Http\Controllers\Admin\UserContoller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
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
    return view('client.pages.index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');


Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/solutions', [SolutionController::class, 'index'])->name('solutions');
        Route::get('/mediasosial', [MedsosController::class, 'index'])->name('mediasosial.index');
        Route::resource('/mediasosial', MedsosController::class);
        Route::get('/create', [MedsosController::class, 'create'])->name('mediasosial.create');

        Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
        Route::resource('/company', CompanyController::class);
        // Route::get('/create', [CompanyController::class, 'create'])->name('company.create');
        Route::get('/company/detail/{id}', [CompanyController::class, 'detail'])->name('company.detail');
        Route::get('/company/detail/{id}/list', [CompanyController::class, 'getCompanyDetail'])->name('company.detail.list');

    });
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::resource('user', UserContoller::class)->middleware('role:super_admin');
});
