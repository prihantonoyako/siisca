<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ScrapingController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\RoleAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Login;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[LoginController::class, 'show'])->name('index');
Route::post('/login',[LoginController::class,'authenticate'])->name('login');
Route::get('/register',[LoginController::class, 'register']);
Route::post('/register/save',[RegisterController::class, 'store']);
Route::get('/tambaharea',[ScrapingController::class, 'tambah_area']);
Route::get('/scrap',[ScrapingController::class, 'scrap']);

Route::get('/dashboard/{is_role_aktif?}', [UserController::class, 'index'])->name('dashboard')->middleware(['auth:pengguna',RoleAuth::class]);
Route::get('/dashboard/getRole',[UserController::class,'getRole'])->name('test')->middleware('auth:pengguna');
// Route::middleware('RoleAuth')->group(function() {
//     Route::prefix('premium')->name('premium.')->group(function() {
//         Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
//     });
// });

Route::get('/statistik/kelembapan',[WeatherController::class, 'kelembapan'])->name('kelembapan')->middleware(RoleAuth::class);
Route::get('/statistik/suhu',[WeatherController::class, 'suhu'])->name('suhu')->middleware(RoleAuth::class);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');