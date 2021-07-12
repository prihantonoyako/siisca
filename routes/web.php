<?php

use App\Http\Middleware\AksesAuth;
use App\Http\Middleware\RoleAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ScrapingController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\Bmkg\StatistikController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PenggunaController;
use App\Http\Controllers\Setting\GroupMenuController;
use App\Http\Controllers\Setting\MenuController;
use App\Http\Controllers\Setting\HakAksesController;
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
Route::group(['name'=>'statistik','prefix' => 'statistik','middleware' => ['auth',AksesAuth::class]], function() {
    Route::get('overview',[StatistikController::class,'index_overview']);
    Route::get('overview/show',[StatistikController::class,'show_overview']);
    Route::get('suhu',[StatistikController::class,'index_suhu']);
    Route::get('kelembapan',[StatistikController::class,'index_kelembapan']);
});
Route::group(['name'=>'account','prefix' => 'account','middleware' => ['auth',AksesAuth::class]], function() {
    Route::get('profile/avatar/{pengguna}',[PenggunaController::class,'upload_avatar']);
    Route::post('profile/avatar/upload_avatar_proses',[PenggunaController::class,'upload_avatar_proses']);
    Route::resource('profile',PenggunaController::class);
});
Route::group(['name'=>'setting','prefix' => 'setting','middleware' => ['auth',AksesAuth::class]], function() {
    Route::resource('menu',MenuController::class);
    Route::resource('group_menu',GroupMenuController::class);
    Route::resource('hak_akses',HakAksesController::class);
    Route::resource('role',RoleController::class);
});

//route for scraping
Route::prefix('scrap')->group(function () {
    Route::get('area',[ScrapingController::class,'tambah_area']);
    Route::get('data',[ScrapingController::class,'scrap']);
});

Route::resource('register',RegisterController::class);
Route::get('/activation',[RegisterController::class,'activation']);
Route::post('/activate',[RegisterController::class,'activate']);

//Bypass for testing purpose
Route::get('/test',[TestingController::class,'index']);