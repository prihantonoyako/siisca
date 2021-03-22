<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ScrapingController;
use App\Http\Controllers\User\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[LoginController::class, 'show']);
Route::post('/login',[LoginController::class,'authenticate']);
Route::get('/register',[LoginController::class, 'register']);
Route::post('/register/save',[RegisterController::class, 'store']);
//Route::get('/',[UserController::class, 'index']);
Route::get('/tambaharea',[ScrapingController::class, 'tambah_area']);
//Route::get('/cuaca',[WeatherController::class, 'cuaca']);
Route::get('/dashboard',[UserController::class,'index']);
Route::get('/scrap',[ScrapingController::class, 'scrap']);
