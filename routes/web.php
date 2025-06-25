<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatistikPenyakitController;
use App\Http\Controllers\Dashboard1Controller;
use App\Http\Controllers\StatistikPoliController;

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard1', [Dashboard1Controller::class, 'index'])->name('dashboard1');

Route::get('/disease-dashboard', function () {
    return view('pages.disease-dashboard');
})->name('disease.dashboard');

// Patient Care Routes

Route::get('/seasonal-trend', function () {
    return view('pages.seasonal-trend');
})->name('seasonal.trend');

// Analytics Routes
Route::get('/patient-demographics', function () {
    return view('pages.patient-demographics');
})->name('patient.demographics');

Route::get('/clinic-visits', function () {
    return view('pages.epoli');
})->name('clinic.visits');

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
