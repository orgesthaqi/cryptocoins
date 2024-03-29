<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('coinmarketcap')->group(function () {
        Route::get('/gainers-losers', [App\Http\Controllers\CoinMarketCapController::class, 'gainers_losers'])->name('gainers-losers');

        Route::get('/trending-cryptocurrencies', [App\Http\Controllers\CoinMarketCapController::class, 'trending_cryptocurrencies'])->name('trending-cryptocurrencies');

        Route::get('/most-viewed-pages', [App\Http\Controllers\CoinMarketCapController::class, 'most_viewed_pages'])->name('most-viewed-pages');

        Route::get('/recently-added', [App\Http\Controllers\CoinMarketCapController::class, 'recently_added'])->name('recently-added');
    });

    Route::prefix('coingecko')->group(function () {
        Route::get('/trending-crypto', [App\Http\Controllers\CoinGeckoController::class, 'trending_crypto'])->name('trending-crypto');
    });
});
