<?php

use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\Action;
use App\Http\Controllers\pages\Base;
use App\Http\Controllers\pages\Catalog;
use App\Http\Controllers\pages\Error;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication\Login;
use App\Http\Controllers\authentication\Register;
use App\Http\Controllers\authentication\ForgotPassword;
use App\Http\Controllers\authentication\Verification;

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

Route::get('/', [Base::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('home', [Base::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->middleware('auth');
Route::get('continents', [Base::class, 'continents'])->name('catalog/continents')->middleware('auth');
Route::get('continents/{continent}', [Catalog::class, 'list'])->name('catalog/continents')->middleware('auth');
Route::get('countries', [Base::class, 'countries'])->name('catalog/countries')->middleware('auth');
Route::get('countries/{country}', [Catalog::class, 'list'])->name('catalog/countries')->middleware('auth');

$subpages = ["monarchs", "reign-periods", "mintage-years", "avers", "revers", "coin-edges", "currencies", "centuries", "metals", "qualities", "prices-by-krause"];

foreach ($subpages as $sub) {
    Route::get($sub, [Catalog::class, 'list'])->name("catalog/" . $sub)->middleware('auth');
}

// Add, edit, delete
Route::get('add', [Action::class, 'add'])->name("action/add")->middleware('auth');
Route::post('add-submit', [Action::class, "addSubmit"]);
Route::get('edit/{id}', [Action::class, 'edit'])->name("action/edit")->middleware('auth');
Route::post('edit-submit/{id}', [Action::class, "editSubmit"]);
Route::resource("/data-table", Catalog::class);
Route::delete("delete/{id}", [Action::class, "delete"]);

// Currency
Route::get('add-currency', [Action::class, 'addCurrency'])->name("action/add-currency")->middleware('auth');
Route::post('add-currency-submit', [Action::class, "addCurrencySubmit"]);
Route::get('edit-currency/{id}', [Action::class, 'editCurrency'])->name("action/edit-currency");
Route::post('edit-currency-submit/{id}', [Action::class, "editCurrencySubmit"]);
Route::delete("delete-currency/{id}", [Action::class, "deleteCurrency"]);

// Authentication
Route::get('/auth/login', [Login::class, 'index'])->name('login');
Route::get('/auth/login/authenticate/', [Login::class, 'authenticate']);
Route::post("/auth/logout", [Login::class, 'logout'])->name("logout");
Route::get('/auth/register', [Register::class, 'index']);
Route::get('auth/register/signup', [Register::class, "signup"]);
Route::get('/auth/forgot-password', [ForgotPassword::class, 'index'])->middleware('guest')->name('password.request');
Route::get('/auth/reset-password', [ForgotPassword::class, 'resetPassword']);
Route::get('/auth/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ForgotPassword::class, "sendPassword"])->middleware('guest')->name('password.update');
Route::get('/email/verify', [Verification::class, 'notice'])->middleware('auth')->name('notice');
Route::get('/email/verify/{id}/{hash}', [Verification::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/resend', [Verification::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('resend');

Route::any('{catchall}', [Error::class, "index"])->where('catchall', '.*');
