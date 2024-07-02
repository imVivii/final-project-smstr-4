<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ApiUserController;
use App\Http\Controllers\API\ApiLoginController;
use App\Http\Controllers\API\ApiKategoriKursusController;
use App\Http\Controllers\API\ApiKursusController;
use App\Http\Controllers\API\ApiMateriKursusController;
use App\Http\Controllers\API\ApiPendaftaranController;
use App\Http\Controllers\API\ApiPembayaranController;
use App\Http\Controllers\API\ApiInformasiController;
use App\Http\Controllers\API\ApiTugasController;
use App\Http\Controllers\API\ApiPengumpulanTugasController;
use App\Http\Controllers\API\ApiPenilaianController;
use App\Http\Controllers\API\ApiKehadiranController;
use App\Http\Controllers\API\ApiIsiKehadiranController;


Route::get("/", function () {
    return response()->json(["message" => "Welcome to API"]);
});

// Route::any("{any}", function () {
//     return response()->json(["message" => "Page Not Found"], 404);
// });


// Route User
// kursus in home api app mobile
Route::get("/kursus-home", [ApiKursusController::class, 'index']);

// guru in home api app mobile
Route::get("/guru-home", [ApiKursusController::class, 'guruHome']);



Route::get('/login', [ApiUserController::class, 'loginGet'])->name('login');
Route::post('/login', [ApiUserController::class, 'login']);
Route::post("/register", [ApiUserController::class, "register"]);

Route::get('/logout', [ApiUserController::class, 'logout'])->middleware('jwt-auth');

Route::get('/login/google', [ApiLoginController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [ApiLoginController::class, 'handleGoogleCallback']);

Route::middleware(['jwt-auth'])->group(function () {

    Route::get('/users', [ApiUserController::class, 'index']);
    Route::get('/users/{id}', [ApiUserController::class, 'show']);
    Route::get('/users/name/{name}', [ApiUserController::class, 'showByName']);
    Route::post('/users', [ApiUserController::class, 'store']);
    Route::put('/users/{id}', [ApiUserController::class, 'update']);
    Route::delete('/users/{id}', [ApiUserController::class, 'destroy']);

    Route::get('/kategori-kursus', [ApiKategoriKursusController::class, 'index']);
    Route::get('/kategori-kursus/{identifier}', [ApiKategoriKursusController::class, 'show']);
    Route::post('/kategori-kursus', [ApiKategoriKursusController::class, 'store']);
    Route::put('/kategori-kursus/{id}', [ApiKategoriKursusController::class, 'update']);
    Route::delete('/kategori-kursus/{id}', [ApiKategoriKursusController::class, 'destroy']);

    Route::get('/kursus', [ApiKursusController::class, 'index']);

    Route::get('/kursus/{identifier}', [ApiKursusController::class, 'show']);
    Route::get('/kursus/name/{name}', [ApiKursusController::class, 'showByName']);
    Route::post('/kursus', [ApiKursusController::class, 'store']);
    Route::put('/kursus/{id}', [ApiKursusController::class, 'update']);
    Route::delete('/kursus/{id}', [ApiKursusController::class, 'destroy']);

    Route::get('/materi-kursus', [ApiMateriKursusController::class, 'index']);
    Route::get('/materi-kursus/{identifier}', [ApiMateriKursusController::class, 'show']);
    Route::post('/materi-kursus', [ApiMateriKursusController::class, 'store']);
    Route::put('/materi-kursus/{id}', [ApiMateriKursusController::class, 'update']);
    Route::delete('/materi-kursus/{id}', [ApiMateriKursusController::class, 'destroy']);

    Route::get('/pendaftaran', [ApiPendaftaranController::class, 'index']);
    Route::get('/pendaftaran/{id}', [ApiPendaftaranController::class, 'show']);
    Route::post('/pendaftaran', [ApiPendaftaranController::class, 'store']);
    Route::put('/pendaftaran/{id}', [ApiPendaftaranController::class, 'update']);
    Route::delete('/pendaftaran/{id}', [ApiPendaftaranController::class, 'destroy']);

    Route::get('/pembayaran', [ApiPembayaranController::class, 'index']);
    Route::get('/pembayaran/{id}', [ApiPembayaranController::class, 'show']);
    Route::post('/pembayaran', [ApiPembayaranController::class, 'store']);
    Route::put('/pembayaran/{id}', [ApiPembayaranController::class, 'update']);
    Route::delete('/pembayaran/{id}', [ApiPembayaranController::class, 'destroy']);

    Route::get('/informasi', [ApiInformasiController::class, 'index']);
    Route::get('/informasi/{identifier}', [ApiInformasiController::class, 'show']);
    Route::post('/informasi', [ApiInformasiController::class, 'store']);
    Route::put('/informasi/{id}', [ApiInformasiController::class, 'update']);
    Route::delete('/informasi/{id}', [ApiInformasiController::class, 'destroy']);

    Route::get('/tugas', [ApiTugasController::class, 'index']);
    Route::get('/tugas/{id}', [ApiTugasController::class, 'show']);
    Route::post('/tugas', [ApiTugasController::class, 'store']);
    Route::put('/tugas/{id}', [ApiTugasController::class, 'update']);
    Route::delete('/tugas/{id}', [ApiTugasController::class, 'destroy']);

    Route::get('/pengumpulan-tugas', [ApiPengumpulanTugasController::class, 'index']);
    Route::get('/pengumpulan-tugas/{id}', [ApiPengumpulanTugasController::class, 'show']);
    Route::post('/pengumpulan-tugas', [ApiPengumpulanTugasController::class, 'store']);
    Route::put('/pengumpulan-tugas/{id}', [ApiPengumpulanTugasController::class, 'update']);
    Route::delete('/pengumpulan-tugas/{id}', [ApiPengumpulanTugasController::class, 'destroy']);

    Route::get('/penilaian', [ApiPenilaianController::class, 'index']);
    Route::get('/penilaian/{id}', [ApiPenilaianController::class, 'show']);
    Route::post('/penilaian', [ApiPenilaianController::class, 'store']);
    Route::put('/penilaian/{id}', [ApiPenilaianController::class, 'update']);
    Route::delete('/penilaian/{id}', [ApiPenilaianController::class, 'destroy']);

    Route::get('/kehadiran', [ApiKehadiranController::class, 'index']);
    Route::get('/kehadiran/{id}', [ApiKehadiranController::class, 'show']);
    Route::post('/kehadiran', [ApiKehadiranController::class, 'store']);
    Route::put('/kehadiran/{id}', [ApiKehadiranController::class, 'update']);
    Route::delete('/kehadiran/{id}', [ApiKehadiranController::class, 'destroy']);

    Route::get('/isi-kehadiran', [ApiIsiKehadiranController::class, 'index']);
    Route::get('/isi-kehadiran/{id}', [ApiIsiKehadiranController::class, 'show']);
    Route::post('/isi-kehadiran', [ApiIsiKehadiranController::class, 'store']);
    Route::put('/isi-kehadiran/{id}', [ApiIsiKehadiranController::class, 'update']);
    Route::delete('/isi-kehadiran/{id}', [ApiIsiKehadiranController::class, 'destroy']);

});
