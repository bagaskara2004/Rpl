<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assessor\AssessorController;

Route::view('/', 'user/beranda');
Route::view('/tentangkami', 'user/tentangkami');
Route::view('/berita', 'user/berita');
Route::view('/panduan', 'user/panduan');
Route::view('/detail', 'user/detail-berita');
Route::view('/login','auth/login');
Route::view('/rpl','user/rpl');
Route::view('/rpl/diproses','user/diproses');
Route::view('/rpl/diterima','user/diterima');
Route::view('/rpl/ditolak','user/ditolak');
Route::view('/form/datadiri','user/form-datadiri')->name('form.datadiri');
Route::view('/form/pendidikan','user/form-pendidikan')->name('form.pendidikan');
Route::view('/form/asesment','user/form-asesment')->name('form.asesment');
Route::view('/form/pekerjaan','user/form-pekerjaan')->name('form.pekerjaan');
Route::view('/form/pelatihan','user/form-pelatihan')->name('form.pelatihan');


Route::prefix('assesor')->group(function () {
    Route::controller(App\Http\Controllers\Assessor\AssessorController::class)->group(function () {
        Route::get('/', 'index')->name('assesor.index');
        Route::get('/dashboard', 'index')->name('assesor.dashboard');
        Route::get('/data/pendaftar', 'getData')->name('assesor.pendaftar.data'); // route untuk AJAX
        Route::get('/modal/pendaftar/{id}', 'getModalData')->name('assesor.pendaftar.modal'); // endpoint modal
    });
});
