<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PredictionsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DailyPredictionsController;
use App\Http\Controllers\WeeklyPredictionsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Vip\VipController;

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

Route::middleware(['throttle:60, 1'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

    // Route pour afficher les prédictions du jour
    Route::get('/predictions-du-jour', [DailyPredictionsController::class, 'options'])->name('daily-predictions.options');
    Route::get('/predictions-du-jour/{options}', [DailyPredictionsController::class, 'show'])->name('daily-predictions.show');

    // Route pour afficher les prédictions de la semaine en cours
    Route::get('/predictions-de-la-semaine', [WeeklyPredictionsController::class, 'options'])->name('weekly-predictions.options');
    Route::get('/predictions-de-la-semaine/{options}', [WeeklyPredictionsController::class, 'show'])->name('weekly-predictions.show');

    // Route pour afficher les prédictions d'un match spécifique
    Route::get('/predictions/{matchId}', [PredictionsController::class, 'show'])->name('predictions.show');

    // Route pour afficher le formulaire de contact
    Route::get('/contact', [ContactController::class, 'contact'])->name('contactForm');
    Route::post('/contact', [ContactController::class, 'sendContactForm'])->name('contact.send');

    Route::get('/vip', [VipController::class, 'options'])->name('vip.options');
    Route::get('/vip/victoire_ou_match_null', [VipController::class, 'victoire_ou_match_null'])->name('vip.victoire_ou_match_null');
    Route::get('/vip/total', [VipController::class, 'total'])->name('vip.total');

    Route::get('/search', [SearchController::class, 'advanced'])->name('search.advanced-form');
    Route::get('/search/result', [SearchController::class, 'result'])->name('search.result');
});

Auth::routes();

Route::middleware(['throttle:60, 1', 'auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
