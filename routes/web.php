<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assessor\AssessorController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\user\BerandaController;
use App\Http\Controllers\user\BeritaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\user\UserControler;
use App\Http\Controllers\Admin\transkrip\TranskripControler;
use App\Http\Controllers\user\RplController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\UserOnly;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\AssessorOnly;

Route::get('/', [BerandaController::class, 'index'])->name('user.beranda');
Route::get('/berita', [BeritaController::class, 'index'])->name('user.berita');
Route::get('/berita/{berita:slug}', [BeritaController::class, 'detail'])->name('user.berita.detail');
Route::view('/tentangkami', 'user/tentangkami')->name('user.tentangkami');
Route::view('/panduan', 'user/panduan')->name('user.panduan');
Route::view('/login', 'auth/login')->name('auth.login');
Route::view('/rpl', 'user/rpl')->name('user.rpl');
Route::view('/rpl/diproses', 'user/diproses');
Route::view('/rpl/diterima', 'user/diterima');
Route::view('/rpl/ditolak', 'user/ditolak');
Route::view('/form/datadiri', 'user/form-datadiri')->name('user.form.datadiri');
Route::view('/form/pendidikan', 'user/form-pendidikan')->name('user.form.pendidikan');
Route::view('/form/asesment', 'user/form-asesment')->name('user.form.asesment');
Route::view('/form/pekerjaan', 'user/form-pekerjaan')->name('user.form.pekerjaan');
Route::view('/form/pelatihan', 'user/form-pelatihan')->name('user.form.pelatihan');


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('auth.index');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
});
Route::middleware([UserOnly::class])->group(function () {
    Route::get('/rpl', [RplController::class, 'index'])->name('user.rpl');
    Route::match(['get', 'post','put'], '/form/datadiri', [RplController::class, 'datadiri'])->name('user.form.datadiri');
    Route::match(['get', 'post','put'], '/form/pendidikan', [RplController::class, 'pendidikan'])->name('user.form.pendidikan');
    
    Route::view('/rpl/diproses', 'user/diproses');
    Route::view('/rpl/diterima', 'user/diterima');
    Route::view('/rpl/ditolak', 'user/ditolak');
    Route::view('/form/asesment', 'user/form-asesment')->name('user.form.asesment');
    Route::view('/form/pekerjaan', 'user/form-pekerjaan')->name('user.form.pekerjaan');
    Route::view('/form/pelatihan', 'user/form-pelatihan')->name('user.form.pelatihan');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::prefix('assesor')->middleware('assessor.only')->group(function () {
    Route::controller(App\Http\Controllers\Assessor\AssessorController::class)->group(function () {
        Route::get('/', 'index')->name('assesor.index');
        Route::get('/dashboard', 'dashboard')->name('assesor.dashboard');
        Route::get('/dashboard/data', 'getDashboardData')->name('assesor.dashboard.data');
        Route::get('/pendaftar', 'pendaftar')->name('assesor.pendaftar');
        Route::get('/data/pendaftar', 'getData')->name('assesor.pendaftar.data');
        Route::get('/modal/pendaftar/{id}', 'getModalData')->name('assesor.pendaftar.modal');
        Route::get('/modal/assessment/{id}', 'getAssessmentModal');
        Route::match(['get', 'post'], '/transfer-nilai/{id}', [App\Http\Controllers\Assessor\AssessorController::class, 'transferNilai'])->name('assesor.transfer-nilai');
        Route::post('/keputusan', [App\Http\Controllers\Assessor\AssessorController::class, 'storeKeputusan']);
        Route::get('/profile', 'profile')->name('assesor.profile');
        Route::post('/profile/update', 'updateProfile')->name('assesor.profile.update');
        Route::post('/profile/upload-photo', 'uploadPhoto')->name('assesor.profile.upload-photo');
        Route::post('/profile/change-password', 'changePassword')->name('assesor.profile.change-password');
    });

    // Route untuk halaman data diri
    Route::get('/datadiri/{id}', [App\Http\Controllers\assessor\dataDiri\DataDiriControler::class, 'show'])->name('assesor.datadiri.show');

    // Route untuk halaman asesmen
    Route::get('/asesmen/{id}', [App\Http\Controllers\Assessor\AssessorController::class, 'showAsesmen'])->name('assesor.asesmen.show');
});


Route::prefix('admin')->middleware('admin.only')->group(function () {
    // Admin Dashboard Routes
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard.index');

    // User Routes
    Route::get('/user', [UserControler::class, 'index'])->name('admin.user.index');
    Route::get('/user/assessor', [UserControler::class, 'assessor'])->name('admin.user.assessor');
    Route::get('/user/data/assessor', [UserControler::class, 'dataAssessor'])->name('admin.user.data.assessor');
    Route::get('/user/data', [UserControler::class, 'data'])->name('admin.user.data');
    Route::post('/user/block', [UserControler::class, 'block'])->name('admin.user.block');

    // Transkrip Routes
    Route::get('/transkrip', [TranskripControler::class, 'index'])->name('admin.transkrip.index');
    Route::get('/transkrip/data', [TranskripControler::class, 'data'])->name('admin.transkrip.data');
    Route::post('/transkrip', [TranskripControler::class, 'store'])->name('admin.transkrip.store');
    Route::get('/transkrip/{transkripNilai}', [TranskripControler::class, 'show'])->name('admin.transkrip.show');
    Route::put('/transkrip/{transkripNilai}', [TranskripControler::class, 'update'])->name('admin.transkrip.update');
    Route::delete('/transkrip/{transkripNilai}', [TranskripControler::class, 'destroy'])->name('admin.transkrip.destroy');
});
