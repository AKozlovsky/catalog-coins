<?php

use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\Continents;
use App\Http\Controllers\pages\Dashboard;
use App\Http\Controllers\pages\Index;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Index::class, 'dashboard'])->name('dashboard');
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::get('continents', [Index::class, 'continents'])->name('continents');
Route::get('continents/{continent}', [Continents::class, 'continent'])->name("continents");
Route::resource("/list-by-continent", Continents::class);
