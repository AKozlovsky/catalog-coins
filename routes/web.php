<?php

use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\Action;
use App\Http\Controllers\pages\Add;
use App\Http\Controllers\pages\Base;
use App\Http\Controllers\pages\Catalog;
use App\Http\Controllers\pages\Detail;
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

Route::get('/', [Base::class, 'dashboard'])->name('dashboard');
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::get('continents', [Base::class, 'continents'])->name('catalog/continents');
Route::get('continents/{continent}', [Catalog::class, 'list'])->name('catalog/continents');
Route::get('countries', [Base::class, 'countries'])->name('catalog/countries');
Route::get('countries/{country}', [Catalog::class, 'list'])->name('catalog/countries');

$subpages = ["monarchs", "reign-periods", "mintage-years", "avers", "revers", "coin-edges", "currencies", "centuries", "metals", "qualities", "prices-by-krause"];

foreach ($subpages as $sub) {
    Route::get($sub, [Catalog::class, 'list'])->name("catalog/" . $sub);
}

Route::get('add', [Action::class, 'add'])->name("action/add");
// Route::get('edit/{id}', [Detail::class, 'edit'])->name("edit");
Route::resource("/data-table", Catalog::class);
