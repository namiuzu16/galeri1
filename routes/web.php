<?php

use App\Http\Controllers\GaleriController;
use App\Http\Controllers\UserController;
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
Route::get('/',[UserController::class,'index']);
Route::get('register',[UserController::class,'register']);
Route::post('postlog',[UserController::class,'postlog']);
Route::post('postreg',[UserController::class,'postreg']);
Route::get('metu',[UserController::class,'metu']);

Route::resource('galeri', GaleriController::class)->middleware('auth');
