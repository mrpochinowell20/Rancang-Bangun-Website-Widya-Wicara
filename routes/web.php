<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SolutionController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GaleriController;
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
    });
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::resource('user', UserContoller::class)->middleware('role:super_admin');
});
