<?php

use App\Http\Controllers\Bmkg\StatistikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ScrapingController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PenggunaController;
use App\Http\Middleware\RoleAuth;
use Illuminate\Support\Facades\Route;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/register',[LoginController::class, 'register']);
Route::post('/register/save',[RegisterController::class, 'store']);
Route::get('/tambaharea',[ScrapingController::class, 'tambah_area']);
Route::get('/scrap',[ScrapingController::class, 'scrap']);

Route::get('/dashboard/{id_role}', [UserController::class, 'index'])->name('dashboard')->middleware(['auth',RoleAuth::class]);

Route::get('/statistik/kelembapan',[UserController::class, 'statistik'])->name('kelembapan')->middleware(RoleAuth::class);

Route::resource('pengguna', PenggunaController::class);
Route::get('/test',[TestingController::class, 'index'])->name('test');


//Menu
Route::get('/statistik/overview',[StatistikController::class,'overview'])->name('overview')->middleware(['auth',RoleAuth::class]);