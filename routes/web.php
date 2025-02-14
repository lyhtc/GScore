<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/searchscores', [ScoreController::class, 'searchscores'])->name('searchscores');

Route::match(['get', 'post'], '/check-score', [ScoreController::class, 'checkScore'])->name('check-score');

Route::get('/report', [ScoreController::class, 'report'])->name('report');

Route::get('/score/{id}', [ScoreController::class, 'show'])->name('score.show');

Route::get('/setting', function () {
    return view('setting');
})->name('setting');

