<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SolutionController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\MedsosController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserContoller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('client.home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');


Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/solution', [SolutionController::class, 'create'])->name('solution');
        Route::get('/solution', [SolutionController::class, 'store'])->name('solution');
        Route::resource('solution', SolutionController::class);
        Route::get('getSolution', [SolutionController::class, 'getSolution'])->name('solution.list');

        Route::get('/features', [FeatureController::class, 'index'])->name('features');
        Route::get('/feature', [FeatureController::class, 'create'])->name('feature');
        Route::get('/feature', [FeatureController::class, 'store'])->name('feature');
        Route::resource('feature', FeatureController::class);
        Route::get('getFeature', [FeatureController::class, 'getFeature'])->name('feature.list');

        Route::get('/solution/detail/{id}', [SolutionController::class, 'detail'])->name('solution.detail');
        Route::get('/solution/detail/{id}/list', [SolutionController::class, 'getSolutionDetail'])->name('solution.detail.list');

        
        Route::resource('galeri', GaleriController::class);
        Route::get('getGaleri', [GaleriController::class, 'getGaleri'])->name('galeri.list');
        Route::delete('/galeri/{id}/delete', [GaleriController::class, 'destroy']);
        Route::resource('article', ArticleController::class);
        Route::get('getArticle', [ArticleController::class, 'getArticle'])->name('article.list');
        Route::get('getArticlePublish', [ArticleController::class, 'getArticlePublish'])->name('article.list.publish');
        Route::get('getArticleDraft', [ArticleController::class, 'getArticleDraft'])->name('article.list.draft');
        Route::delete('/article/{id}/delete', [ArticleController::class, 'destroy']);
        Route::get('/mediasosial', [MedsosController::class, 'index'])->name('mediasosial.index');
        Route::resource('/mediasosial', MedsosController::class);
        Route::get('/create', [MedsosController::class, 'create'])->name('mediasosial.create');

        Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
        Route::resource('/company', CompanyController::class);
        Route::get('/company/detail/{id}', [CompanyController::class, 'detail'])->name('company.detail');
        Route::get('/company/detail/{id}/list', [CompanyController::class, 'getCompanyDetail'])->name('company.detail.list');
        Route::resource('partner', PartnerController::class);
        Route::get('getPartner', [PartnerController::class, 'getPartner'])->name('partner.list');
        Route::delete('/partner/{id}/delete', [PartnerController::class, 'destroy']);
        Route::resource('testimonial', TestimonialController::class);
        Route::get('testimonial/edit/{id}', [TestimonialController::class, 'edit']);
        Route::get('getTestimonial', [TestimonialController::class, 'getTestimonial'])->name('testimonial.list');
        Route::delete('/testimonial/{id}/delete', [TestimonialController::class, 'destroy']);
    });
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::resource('user', UserContoller::class)->middleware('role:super_admin');
});
