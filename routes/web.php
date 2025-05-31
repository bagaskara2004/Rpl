<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assessor\AssessorController;

Route::view('/', 'user/beranda');
Route::view('/tentangkami', 'user/tentangkami');
Route::view('/berita', 'user/berita');
Route::view('/panduan', 'user/panduan');


Route::prefix('assesor')->group(function () {
    Route::controller(App\Http\Controllers\Assessor\AssessorController::class)->group(function () {
        Route::get('/', 'index')->name('assesor.index');
        Route::get('/dashboard', 'index')->name('assesor.dashboard');
    });
});

