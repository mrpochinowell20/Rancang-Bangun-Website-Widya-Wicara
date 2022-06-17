<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SolutionController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserContoller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Node\CrapIndex;

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

Route::get('/', [UserDashboardController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');


Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/solutions', [SolutionController::class, 'index'])->name('solutions');
        Route::resource('partner', PartnerController::class);
        Route::get('getPartner', [PartnerController::class, 'getPartner'])->name('partner.list');
        Route::delete('/partner/{id}/delete', [PartnerController::class, 'destroy']);
        Route::resource('testimonial', TestimonialController::class);
        Route::get('getTestimonial', [TestimonialController::class, 'getTestimonial'])->name('testimonial.list');
        Route::delete('/testimonial/{id}/delete', [TestimonialController::class, 'destroy']);
    });
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::resource('user', UserContoller::class)->middleware('role:super_admin');
});
