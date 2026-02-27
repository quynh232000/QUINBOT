<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('scan.trends', [\App\Http\Controllers\DashboardController::class, 'scanTrends'])->name('scan.trends');