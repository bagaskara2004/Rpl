<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assessor\AssessorController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\user\BerandaController;
use App\Http\Controllers\user\BeritaController;
use App\Http\Controllers\user\RplController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\UserOnly;

Route::get('/', [BerandaController::class, 'index'])->name('user.beranda');
Route::get('/berita', [BeritaController::class, 'index'])->name('user.berita');
Route::get('/berita/{berita:slug}', [BeritaController::class, 'detail'])->name('user.berita.detail');
Route::view('/tentangkami', 'user/tentangkami')->name('user.tentangkami');
Route::view('/panduan', 'user/panduan')->name('user.panduan');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('auth.index');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
});
Route::middleware([UserOnly::class])->group(function () {
    Route::get('/rpl', [RplController::class, 'index'])->name('user.rpl');
    Route::match(['get', 'post','put'], '/form/datadiri', [RplController::class, 'datadiri'])->name('user.form.datadiri');
    Route::match(['get', 'post','put'], '/form/pendidikan', [RplController::class, 'pendidikan'])->name('user.form.pendidikan');
    Route::match(['get', 'post','put','delete'], '/form/asesment', [RplController::class, 'asesment'])->name('user.form.asesment');
    
    Route::view('/rpl/diproses', 'user/diproses');
    Route::view('/rpl/diterima', 'user/diterima');
    Route::view('/rpl/ditolak', 'user/ditolak');
    Route::view('/form/pekerjaan', 'user/form-pekerjaan')->name('user.form.pekerjaan');
    Route::view('/form/pelatihan', 'user/form-pelatihan')->name('user.form.pelatihan');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::prefix('assesor')->group(function () {
    Route::controller(App\Http\Controllers\Assessor\AssessorController::class)->group(function () {
        Route::get('/', 'index')->name('assesor.index');
        Route::get('/dashboard', 'index')->name('assesor.dashboard');
        Route::get('/data/pendaftar', 'getData')->name('assesor.pendaftar.data'); // route untuk AJAX
        Route::get('/modal/pendaftar/{id}', 'getModalData')->name('assesor.pendaftar.modal'); // endpoint modal
        Route::get('/modal/assessment/{id}', 'getAssessmentModal'); // endpoint modal assessment
        Route::match(['get', 'post'], '/transfer-nilai/{id}', [App\Http\Controllers\Assessor\AssessorController::class, 'transferNilai'])->name('assesor.transfer-nilai');
    });
});
