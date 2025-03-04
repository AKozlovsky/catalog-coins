<?php

use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\Action;
use App\Http\Controllers\pages\Base;
use App\Http\Controllers\pages\Catalog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication\Login;
use App\Http\Controllers\authentication\Register;
use App\Http\Controllers\authentication\ForgotPassword;

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

// Add, edit, delete
Route::get('add', [Action::class, 'add'])->name("action/add");
Route::get('edit/{id}', [Action::class, 'edit'])->name("action/edit");
Route::post('add-submit', [Action::class, "addSubmit"]);
Route::post('edit-submit/{id}', [Action::class, "editSubmit"]);
Route::resource("/data-table", Catalog::class);
Route::delete("delete/{id}", [Action::class, "delete"]);

// Currency
Route::get('add-currency', [Action::class, 'addCurrency'])->name("action/add-currency");
Route::get('edit-currency/{id}', [Action::class, 'editCurrency'])->name("action/edit-currency");
Route::post('add-currency-submit', [Action::class, "addCurrencySubmit"]);
Route::post('edit-currency-submit/{id}', [Action::class, "editCurrencySubmit"]);
Route::delete("delete-currency/{id}", [Action::class, "deleteCurrency"]);

// Authentication
Route::get('/auth/login', [Login::class, 'index']);
Route::get('/auth/register', [Register::class, 'index']);
Route::get('/auth/forgot-password', [ForgotPassword::class, 'index']);
