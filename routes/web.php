<?php
use App\Models\JadwalDokter;
use App\Http\Controllers\Dashbord22Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalDokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatistikPenyakitController;
use App\Http\Controllers\Dashboard1Controller;
use App\Http\Controllers\StatistikPoliController;
use App\Http\Controllers\KunjunganPasienController;
use App\Http\Controllers\PasienPerJenisKelaminController;

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard1', [Dashboard1Controller::class, 'index'])->name('dashboard1');

Route::get('/disease-dashboard', function () {
    return view('pages.disease-dashboard');
})->name('disease.dashboard');

// Patient Care Routes


Route::get('/kunjungan', [KunjunganPasienController::class, 'index'])->name('pages.kunjunganpasien');
Route::post('/kunjungan', [KunjunganPasienController::class, 'store']);
Route::delete('/kunjungan/{id}', [KunjunganPasienController::class, 'destroy']);

Route::get('/clinic-visits', function () {
    return view('pages.epoli');
})->name('clinic.visits');

// Doctor Schedule Route
Route::get('/jadwal-dokter', function () {
    $data = JadwalDokter::all();
    return view('pages.dokter_des', compact('data'));
})->name('jadwal.dokter');


// Home redirect
Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/', function () {
    return redirect('/dashboard');
});



Route::get('/statistik', [StatistikPenyakitController::class, 'index'])->name('pbb.index');
Route::post('/statistik', [StatistikPenyakitController::class, 'store']);
Route::get('/statistik/{id}/edit', [StatistikPenyakitController::class, 'edit']);
Route::put('/statistik/{id}', [StatistikPenyakitController::class, 'update']);
Route::delete('/statistik/{id}', [StatistikPenyakitController::class, 'destroy']);


Route::get('/statistikPoli', [StatistikPoliController::class, 'index'])->name('epoli.index');
Route::post('/statistikPoli', [StatistikPoliController::class, 'store']);
Route::get('/statistikPoli/{id}/edit', [StatistikPoliController::class, 'edit']);
Route::put('/statistikPoli/{id}', [StatistikPoliController::class, 'update']);
Route::delete('/statistikPoli/{id}', [StatistikPoliController::class, 'destroy']);

Route::get('/pasien-jenis-kelamin', [PasienPerJenisKelaminController::class, 'index'])->name('jk.index');
Route::post('/pasien-jenis-kelamin', [PasienPerJenisKelaminController::class, 'store']);
Route::delete('/pasien-jenis-kelamin/{id}', [PasienPerJenisKelaminController::class, 'destroy']);

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard-des', [Dashbord22Controller::class, 'index'])->name('dashboard_des');


//dokter
Route::get('/jadwal', [JadwalDokterController::class, 'index'])->name('jadwal.index');
Route::post('/jadwal', [JadwalDokterController::class, 'store']);
Route::get('/jadwal/{id}/edit', [JadwalDokterController::class, 'edit']);
Route::put('/jadwal/{id}', [JadwalDokterController::class, 'update']);
Route::delete('/jadwal/{id}', [JadwalDokterController::class, 'destroy']);