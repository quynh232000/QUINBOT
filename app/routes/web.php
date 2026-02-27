<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrendController;
use App\Http\Controllers\VideoProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::post('scan/trends', [DashboardController::class, 'scanTrends'])->name('scan.trends');
Route::get('/trends', [TrendController::class, 'index'])->name('trends.index');
Route::get('/trends/{id}/approve', [TrendController::class, 'approve'])->name('trends.approve');

Route::get('/video-project', [VideoProjectController::class, 'index'])->name('video-project.index');
Route::get('/video-project/{id}', [VideoProjectController::class, 'show'])->name('video-project.show');