<?php

use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\Catalog;
use App\Http\Controllers\pages\Continents;
use App\Http\Controllers\pages\Detail;
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
Route::get('continents/{continent}', [Catalog::class, 'list'])->name("continents");
Route::get('countries', [Index::class, 'countries'])->name('countries');
Route::get('countries/{country}', [Catalog::class, 'list'])->name('countries');
Route::get('edit/{id}', [Detail::class, 'edit'])->name("edit");
Route::resource("/data-table", Catalog::class);
