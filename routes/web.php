<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assessor\AssessorController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\user\BerandaController;
use App\Http\Controllers\user\BeritaController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [BerandaController::class, 'index'])->name('user.beranda');
Route::get('/berita', [BeritaController::class, 'index'])->name('user.berita');
Route::get('/berita/{berita:slug}', [BeritaController::class, 'detail'])->name('user.berita.detail');
Route::view('/tentangkami', 'user/tentangkami')->name('user.tentangkami');
Route::view('/panduan', 'user/panduan')->name('user.panduan');

Route::get('/login',[LoginController::class,'index'])->name('auth.index');
Route::post('/login',[LoginController::class,'login'])->name('auth.login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::view('/rpl','user/rpl')->name('user.rpl');
Route::view('/rpl/diproses','user/diproses');
Route::view('/rpl/diterima','user/diterima');
Route::view('/rpl/ditolak','user/ditolak');
Route::view('/form/datadiri','user/form-datadiri')->name('user.form.datadiri');
Route::view('/form/pendidikan','user/form-pendidikan')->name('user.form.pendidikan');
Route::view('/form/asesment','user/form-asesment')->name('user.form.asesment');
Route::view('/form/pekerjaan','user/form-pekerjaan')->name('user.form.pekerjaan');
Route::view('/form/pelatihan','user/form-pelatihan')->name('user.form.pelatihan');


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
