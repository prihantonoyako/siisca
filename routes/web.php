<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ScrapingController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Login;

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
Route::get('/',[LoginController::class, 'show']);
Route::post('/login',[LoginController::class,'authenticate'])->name('login');
Route::get('/register',[LoginController::class, 'register']);
Route::post('/register/save',[RegisterController::class, 'store']);
//Route::get('/',[UserController::class, 'index']);
Route::get('/tambaharea',[ScrapingController::class, 'tambah_area']);
//Route::get('/cuaca',[WeatherController::class, 'cuaca']);
//Route::get('/dashboard',[UserController::class,'index']);
Route::get('/scrap',[ScrapingController::class, 'scrap']);

// Route::group(['middleware' => ['guest:pengguna']], function() {
//     Route::post('/', [LoginController::class, 'show'])->name('login');
//     Route::post('/', [LoginController::class, 'authenticate']);
// });
Route::resource('/dashboard', UserController::class)->middleware('auth:pengguna');
// Route::group(['middleware' => ['guest:admin', 'guest:operator']], function() {
//     Route::get('/', [LoginController::class, 'index'])->name('login');
//     Route::post('/', [LoginController::class, 'authenticate']);
// });
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::group(['middleware' => ['auth:admin', 'auth:operator']], function() {
    
// });
// Route::resource('/parkir', ParkirController::class)->middleware('auth:operator');
// Route::resource('/jenis_kendaraan', JenisKendaraanController::class)->middleware('auth:admin');
// Route::resource('/kapasitas', KonfigurasiKapasitasController::class)->middleware('auth:admin');
// Route::resource('/tarif', KonfigurasiTarifController::class)->middleware('auth:admin');
// Route::resource('/admin', AdminController::class)->middleware('auth:admin');
// Route::resource('/operator', OperatorController::class)->middleware('auth:admin');