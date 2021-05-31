<?php

use App\Http\Controllers\Bmkg\StatistikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ScrapingController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PenggunaController;
use App\Http\Middleware\AksesAuth;
use App\Http\Middleware\RoleAuth;
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
Route::get('/',[LoginController::class, 'show'])->name('index');

Route::post('/login',[LoginController::class,'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard/{id_role}', [UserController::class, 'index'])->name('dashboard')->middleware(['auth',RoleAuth::class]);

//Menu
Route::group(['prefix' => 'statistik','middleware' => ['auth',AksesAuth::class]], function() {
    Route::get('overview',[StatistikController::class,'overview']);
});
Route::group(['prefix' => 'account','middleware' => ['auth',AksesAuth::class]], function() {
    Route::view('/profile', 'portal.coming-soon');
});
Route::group(['prefix' => 'setting','middleware' => ['auth',AksesAuth::class]], function() {
    
});

//route for scraping
Route::prefix('scrap')->group(function () {
    Route::get('area',[ScrapingController::class,'tambah_area']);
    Route::get('data',[ScrapingController::class,'scrap']);
});

Route::resource('register',RegisterController::class);
Route::get('/activation',[RegisterController::class,'activation']);
Route::post('/activate',[RegisterController::class,'activate']);

Route::resource('pengguna', PenggunaController::class);

Route::get('/test',[TestingController::class, 'index'])->name('test');

