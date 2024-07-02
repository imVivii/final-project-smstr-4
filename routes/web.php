<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Auth Controllers
use App\Http\Controllers\Auth\LoginController;

// Dashboard Controllers
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DashboardSiswaController;

// Admin Controllers
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminKategoriKursusController;
use App\Http\Controllers\AdminKursusController;
use App\Http\Controllers\AdminTugasController;
use App\Http\Controllers\AdminPengumpulanTugasController;
use App\Http\Controllers\AdminPenilaianController;
use App\Http\Controllers\AdminKehadiranController;
use App\Http\Controllers\AdminIsiKehadiranController;
use App\Http\Controllers\AdminPendaftaranController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\AdminInformasiController;
use App\Http\Controllers\AdminMateriKursusController;
use App\Http\Controllers\AdminPengaturanController;

// Guru Controllers
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruKursusController;
use App\Http\Controllers\GuruTugasController;
use App\Http\Controllers\GuruPengumpulanTugasController;
use App\Http\Controllers\GuruPenilaianController;
use App\Http\Controllers\GuruKehadiranController;
use App\Http\Controllers\GuruMateriKursusController;

// Siswa Controllers
use App\Http\Controllers\SiswaKursusController;
use App\Http\Controllers\SiswaKursusAktifController;
use App\Http\Controllers\SiswaPendaftaranController;
use App\Http\Controllers\SiswaPembayaranController;
use App\Http\Controllers\SiswaInformasiController;
use App\Http\Controllers\SiswaMateriKursusController;
use App\Http\Controllers\SiswaPengumpulanTugasController;
use App\Http\Controllers\SiswaPenilaianController;
use App\Http\Controllers\SiswaIsiKehadiranController;
use App\Http\Controllers\SiswaKehadiranController;
use App\Http\Controllers\SiswaProfilController;
use App\Http\Controllers\SiswaTugasController;
use App\Http\Controllers\SiswaController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', [AdminUserController::class, 'welcome'])->name('welcome');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('welcome');
})->name('logout');

Auth::routes();

Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google')->middleware('throttle.login');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->middleware('throttle.login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('throttle.login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('kursus', AdminKursusController::class);
    Route::resource('kategoriKursus', AdminKategoriKursusController::class);
    Route::resource('pendaftaran', AdminPendaftaranController::class);
    Route::get('pendaftaran/{id}/edit', [App\Http\Controllers\AdminPendaftaranController::class, 'edit'])->name('admin.pendaftaran.edit');
    Route::resource('pembayaran', AdminPembayaranController::class);
    Route::resource('informasi', AdminInformasiController::class);
    Route::get('/pengaturan', [AdminPengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::post('/pengaturan', [AdminPengaturanController::class, 'update'])->name('pengaturan.update');
    Route::resource('materi', AdminMateriKursusController::class);
    Route::resource('tugas', AdminTugasController::class);
    Route::resource('pengumpulanTugas', AdminPengumpulanTugasController::class);
    Route::resource('penilaian', AdminPenilaianController::class);
    Route::resource('kehadiran', AdminKehadiranController::class);
    Route::resource('isi_kehadiran', AdminIsiKehadiranController::class);
});

// Guru routes
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('dashboard', [DashboardGuruController::class, 'dashboard'])->name('dashboard');
    Route::resource('kursus', GuruKursusController::class);
    Route::resource('tugas', GuruTugasController::class);
    Route::resource('pengumpulan_tugas', GuruPengumpulanTugasController::class);
    Route::get('/profile', [GuruController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [GuruController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [GuruController::class, 'updateProfile'])->name('profile.update');
    Route::resource('materi', GuruMateriKursusController::class);
    Route::resource('penilaian', GuruPenilaianController::class);
    Route::prefix('kehadiran')->name('kehadiran.')->controller(GuruKehadiranController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{kursus_id}/{tanggal}', 'show')->name('show');
        Route::get('{kursus_id}/{tanggal}/edit', 'edit')->name('edit');
        Route::put('{kursus_id}/{tanggal}', 'update')->name('update');
        Route::delete('{kursus_id}/{tanggal}', 'destroy')->name('destroy');
    });
});


// Siswa routes
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [DashboardSiswaController::class, 'dashboard'])->name('dashboard');

    Route::resource('kursus', SiswaKursusController::class);
    Route::resource('pendaftaran', SiswaPendaftaranController::class)->except(['create', 'store', 'edit', 'update']);
    Route::resource('pendaftaran', SiswaPendaftaranController::class)->except(['create', 'store', 'edit', 'update']);
    Route::post('pendaftaran/store', [SiswaPendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('pembayaran/create/{kursus_id}', [SiswaPembayaranController::class, 'create'])->name('pembayaran.create');
    
    Route::get('pembayaran/create/{kursus_id}', [SiswaPembayaranController::class, 'create'])->name('pembayaran.create');
    Route::resource('pembayaran', SiswaPembayaranController::class)->except(['create']);
    
    Route::resource('kursus_saya', SiswaKursusAktifController::class)->only(['index', 'show']);
    Route::resource('materi', SiswaMateriKursusController::class);
    Route::resource('tugas', SiswaTugasController::class)->only(['index', 'show']);
    
    Route::get('pengumpulan_tugas/create/{tugas_id}', [SiswaPengumpulanTugasController::class, 'create'])->name('pengumpulan_tugas.create');
    Route::resource('pengumpulan_tugas', SiswaPengumpulanTugasController::class)->except(['create']);
    
    Route::resource('kehadiran', SiswaKehadiranController::class)->only(['index']);
    Route::resource('isi_kehadiran', SiswaIsiKehadiranController::class);
    Route::get('kehadiran/isi/{kehadiran_id}', [SiswaKehadiranController::class, 'isi'])->name('kehadiran.isi');
    Route::resource('kehadiran', SiswaKehadiranController::class)->only(['index', 'show']);
    Route::get('isi_kehadiran/create/{kehadiran_id}', [SiswaIsiKehadiranController::class, 'create'])->name('isi_kehadiran.create');
    Route::post('isi_kehadiran/store', [SiswaIsiKehadiranController::class, 'store'])->name('isi_kehadiran.store');
    Route::resource('isi_kehadiran', SiswaIsiKehadiranController::class)->only(['index']);
    Route::resource('penilaian', SiswaPenilaianController::class);
    Route::resource('informasi', SiswaInformasiController::class);
    Route::resource('penilaian', SiswaPenilaianController::class);
    Route::get('/profile', [SiswaController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [SiswaController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [SiswaController::class, 'updateProfile'])->name('profile.update');
});

