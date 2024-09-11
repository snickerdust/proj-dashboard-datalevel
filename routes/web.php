<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DataController::class,"dataset"])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/chart-data', [DataController::class, 'getData']);
Route::get('/provinces', [DataController::class, 'getProvinces']);
Route::get('/chart-data-bar', [DataController::class, 'getBarChartData']);
Route::get('/treemap-data', [DataController::class, 'getTreemapData']);
Route::get('/datajual', [DataController::class, 'jualan'])->name('datajual');
Route::get('/databeli', [DataController::class, 'belii'])->name('databeli');



// Route::get('/dataset', [DataController::class, 'index']);

require __DIR__.'/auth.php';