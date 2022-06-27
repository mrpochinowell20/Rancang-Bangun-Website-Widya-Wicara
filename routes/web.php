<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SolutionController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TestimonialController;
=======
use App\Http\Controllers\Admin\MedsosController;
>>>>>>> 388432a1763e625674b434b658a551ac3fdec1b0
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
<<<<<<< HEAD
        Route::resource('partner', PartnerController::class);
        Route::get('getPartner', [PartnerController::class, 'getPartner'])->name('partner.list');
        Route::delete('/partner/{id}/delete', [PartnerController::class, 'destroy']);
        Route::resource('testimonial', TestimonialController::class);
        Route::get('testimonial/edit/{id}', [TestimonialController::class, 'edit']);
        Route::get('getTestimonial', [TestimonialController::class, 'getTestimonial'])->name('testimonial.list');
        Route::delete('/testimonial/{id}/delete', [TestimonialController::class, 'destroy']);
=======
        Route::get('/mediasosial', [MedsosController::class, 'index'])->name('mediasosial.index');
        Route::resource('/mediasosial', MedsosController::class);
        Route::get('/create', [MedsosController::class, 'create'])->name('mediasosial.create');

        Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
        Route::resource('/company', CompanyController::class);
        // Route::get('/create', [CompanyController::class, 'create'])->name('company.create');
        Route::get('/company/detail/{id}', [CompanyController::class, 'detail'])->name('company.detail');
        Route::get('/company/detail/{id}/list', [CompanyController::class, 'getCompanyDetail'])->name('company.detail.list');

>>>>>>> 388432a1763e625674b434b658a551ac3fdec1b0
    });
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::resource('user', UserContoller::class)->middleware('role:super_admin');
});
