<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect()->route('laporan.create');
});

Route::get('/lapor', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/lapor', [LaporanController::class, 'store'])->name('laporan.store');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// --- ROUTE TERPROTEKSI (Wajib Login Petugas) ---
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Pengelolaan Laporan (Hanya Petugas)
    Route::resource('laporan', LaporanController::class)->except(['create', 'store']);

    // Profil Petugas
    Route::get('/profil', function () {
        return view('petugas.profil');
    })->name('petugas.profil');
});