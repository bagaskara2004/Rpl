<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assessor\AssessorController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\user\BerandaController;
use App\Http\Controllers\user\BeritaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\user\UserControler;
use App\Http\Controllers\Admin\transkrip\TranskripControler;
use App\Http\Controllers\Admin\datadiri\DataDiriController;
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
    Route::match(['get', 'post', 'put'], '/form/datadiri', [RplController::class, 'datadiri'])->name('user.form.datadiri');
    Route::match(['get', 'post', 'put'], '/form/pendidikan', [RplController::class, 'pendidikan'])->name('user.form.pendidikan');

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

    // Admin Profile Routes
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/profile/upload-photo', [AdminController::class, 'uploadPhoto'])->name('admin.profile.upload-photo');
    Route::post('/profile/change-password', [AdminController::class, 'changePassword'])->name('admin.profile.change-password');

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

    // Data Diri Routes
    Route::get('/data-diri', [DataDiriController::class, 'index'])->name('admin.datadiri.index');
    Route::get('/data-diri/data', [DataDiriController::class, 'getData'])->name('admin.datadiri.data');
    Route::get('/data-diri/{id}', [DataDiriController::class, 'show'])->name('admin.datadiri.show');

    // Pertanyaan Routes
    Route::get('/question', [App\Http\Controllers\Admin\pertanyaan\PertanyaanControle::class, 'index'])->name('admin.pertanyaan.index');
    Route::get('/question/data', [App\Http\Controllers\Admin\pertanyaan\PertanyaanControle::class, 'getData'])->name('admin.pertanyaan.data');
    Route::post('/question', [App\Http\Controllers\Admin\pertanyaan\PertanyaanControle::class, 'store'])->name('admin.pertanyaan.store');
    Route::get('/question/{id}', [App\Http\Controllers\Admin\pertanyaan\PertanyaanControle::class, 'show'])->name('admin.pertanyaan.show');
    Route::put('/question/{id}', [App\Http\Controllers\Admin\pertanyaan\PertanyaanControle::class, 'update'])->name('admin.pertanyaan.update');
    Route::delete('/question/{id}', [App\Http\Controllers\Admin\pertanyaan\PertanyaanControle::class, 'destroy'])->name('admin.pertanyaan.destroy');

    // Kurikulum Routes
    Route::get('/kurikulum', [App\Http\Controllers\Admin\kurikulum\KurikulumController::class, 'index'])->name('admin.kurikulum.index');
    Route::get('/kurikulum/data', [App\Http\Controllers\Admin\kurikulum\KurikulumController::class, 'getData'])->name('admin.kurikulum.data');
    Route::post('/kurikulum', [App\Http\Controllers\Admin\kurikulum\KurikulumController::class, 'store'])->name('admin.kurikulum.store');
    Route::get('/kurikulum/{id}', [App\Http\Controllers\Admin\kurikulum\KurikulumController::class, 'show'])->name('admin.kurikulum.show');
    Route::put('/kurikulum/{id}', [App\Http\Controllers\Admin\kurikulum\KurikulumController::class, 'update'])->name('admin.kurikulum.update');
    Route::delete('/kurikulum/{id}', [App\Http\Controllers\Admin\kurikulum\KurikulumController::class, 'destroy'])->name('admin.kurikulum.destroy');

    // Transfer Nilai Routes
    Route::get('/transfer-hasil', [App\Http\Controllers\Admin\transfer\TransferNiliaController::class, 'index'])->name('admin.transfer.index');
    Route::get('/transfer-hasil/data', [App\Http\Controllers\Admin\transfer\TransferNiliaController::class, 'getData'])->name('admin.transfer.data');
    Route::get('/transfer-hasil/{userId}/detail', [App\Http\Controllers\Admin\transfer\TransferNiliaController::class, 'getDetailTransfer'])->name('admin.transfer.detail');
    Route::get('/transfer-hasil/{id}', [App\Http\Controllers\Admin\transfer\TransferNiliaController::class, 'show'])->name('admin.transfer.show');


    // Testing routes
    Route::get('/transfer-hasil/test/query', [App\Http\Controllers\Admin\transfer\TransferNiliaController::class, 'testQuery'])->name('admin.transfer.test');
    Route::get('/transfer-hasil/test/detail/{userId?}', [App\Http\Controllers\Admin\transfer\TransferNiliaController::class, 'testDetailQuery'])->name('admin.transfer.test.detail');

    // Keputusan Routes
    Route::get('/keputusan', [App\Http\Controllers\Admin\keputusan\KeputusanControler::class, 'index'])->name('admin.keputusan.index');
    Route::get('/keputusan/data', [App\Http\Controllers\Admin\keputusan\KeputusanControler::class, 'getData'])->name('admin.keputusan.data');
    Route::get('/keputusan/{id}', [App\Http\Controllers\Admin\keputusan\KeputusanControler::class, 'show'])->name('admin.keputusan.show');
    Route::post('/keputusan', [App\Http\Controllers\Admin\keputusan\KeputusanControler::class, 'store'])->name('admin.keputusan.store');
    Route::put('/keputusan/{id}', [App\Http\Controllers\Admin\keputusan\KeputusanControler::class, 'update'])->name('admin.keputusan.update');
    Route::delete('/keputusan/{id}', [App\Http\Controllers\Admin\keputusan\KeputusanControler::class, 'destroy'])->name('admin.keputusan.destroy');

    // Kelas Routes
    Route::get('/kelas', [App\Http\Controllers\Admin\kelas\KelasController::class, 'index'])->name('admin.kelas.index');
    Route::get('/kelas/data', [App\Http\Controllers\Admin\kelas\KelasController::class, 'getData'])->name('admin.kelas.data');
    Route::get('/kelas/{id}', [App\Http\Controllers\Admin\kelas\KelasController::class, 'show'])->name('admin.kelas.show');
    Route::post('/kelas', [App\Http\Controllers\Admin\kelas\KelasController::class, 'store'])->name('admin.kelas.store');
    Route::put('/kelas/{id}', [App\Http\Controllers\Admin\kelas\KelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/kelas/{id}', [App\Http\Controllers\Admin\kelas\KelasController::class, 'destroy'])->name('admin.kelas.destroy');

    // Pertemuan Routes
    Route::get('/kelas/{kelasId}/pertemuan', [App\Http\Controllers\Admin\kelas\PertemuanController::class, 'index'])->name('admin.pertemuan.index');
    Route::get('/kelas/{kelasId}/pertemuan/data', [App\Http\Controllers\Admin\kelas\PertemuanController::class, 'getData'])->name('admin.pertemuan.data');
    Route::get('/kelas/{kelasId}/mata-kuliah', [App\Http\Controllers\Admin\kelas\PertemuanController::class, 'getMataKuliah'])->name('admin.pertemuan.mata-kuliah');
    Route::get('/kelas/{kelasId}/pertemuan/{id}', [App\Http\Controllers\Admin\kelas\PertemuanController::class, 'show'])->name('admin.pertemuan.show');
    Route::post('/kelas/{kelasId}/pertemuan', [App\Http\Controllers\Admin\kelas\PertemuanController::class, 'store'])->name('admin.pertemuan.store');
    Route::put('/kelas/{kelasId}/pertemuan/{id}', [App\Http\Controllers\Admin\kelas\PertemuanController::class, 'update'])->name('admin.pertemuan.update');
    Route::delete('/kelas/{kelasId}/pertemuan/{id}', [App\Http\Controllers\Admin\kelas\PertemuanController::class, 'destroy'])->name('admin.pertemuan.destroy');

    // Absensi Routes
    Route::get('/pertemuan/{pertemuanId}/absensi', [App\Http\Controllers\Admin\kelas\AbsensiController::class, 'index'])->name('admin.absensi.index');
    Route::get('/pertemuan/{pertemuanId}/absensi/data', [App\Http\Controllers\Admin\kelas\AbsensiController::class, 'getData'])->name('admin.absensi.data');
    Route::get('/absensi/users', [App\Http\Controllers\Admin\kelas\AbsensiController::class, 'getUsers'])->name('admin.absensi.users');
    Route::get('/absensi/{id}', [App\Http\Controllers\Admin\kelas\AbsensiController::class, 'show'])->name('admin.absensi.show');
    Route::post('/absensi', [App\Http\Controllers\Admin\kelas\AbsensiController::class, 'store'])->name('admin.absensi.store');
    Route::put('/absensi/{id}', [App\Http\Controllers\Admin\kelas\AbsensiController::class, 'update'])->name('admin.absensi.update');
    Route::delete('/absensi/{id}', [App\Http\Controllers\Admin\kelas\AbsensiController::class, 'destroy'])->name('admin.absensi.destroy');

    // Mata Kuliah Routes
    Route::get('/mata-kuliah', [App\Http\Controllers\Admin\matakuliah\MataKuliahController::class, 'index'])->name('admin.matakuliah.index');
    Route::get('/mata-kuliah/data', [App\Http\Controllers\Admin\matakuliah\MataKuliahController::class, 'getData'])->name('admin.matakuliah.data');
    Route::get('/mata-kuliah/kelas', [App\Http\Controllers\Admin\matakuliah\MataKuliahController::class, 'getKelas'])->name('admin.matakuliah.kelas');
    Route::get('/mata-kuliah/dosen', [App\Http\Controllers\Admin\matakuliah\MataKuliahController::class, 'getDosen'])->name('admin.matakuliah.dosen');
    Route::get('/mata-kuliah/{id}', [App\Http\Controllers\Admin\matakuliah\MataKuliahController::class, 'show'])->name('admin.matakuliah.show');
    Route::post('/mata-kuliah', [App\Http\Controllers\Admin\matakuliah\MataKuliahController::class, 'store'])->name('admin.matakuliah.store');
    Route::put('/mata-kuliah/{id}', [App\Http\Controllers\Admin\matakuliah\MataKuliahController::class, 'update'])->name('admin.matakuliah.update');
    Route::delete('/mata-kuliah/{id}', [App\Http\Controllers\Admin\matakuliah\MataKuliahController::class, 'destroy'])->name('admin.matakuliah.destroy');
});
