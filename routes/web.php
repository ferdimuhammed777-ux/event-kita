<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrasiController;

// 1. LANDING PAGE & DETAIL EVENT
Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.detail');

// 2. AUTH USER (LOGIN/REGISTER)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. AREA USER (Wajib Login)
Route::middleware(['auth'])->group(function () {
    // Dashboard User
    Route::get('/dashboard', [RegistrasiController::class, 'index'])->name('user.dashboard');
    // Proses Daftar Event
    Route::post('/daftar-event/{event_id}', [RegistrasiController::class, 'store'])->name('event.daftar');
    // Lihat Tiket
    Route::get('/tiket/{kode_registrasi}', [RegistrasiController::class, 'showTicket'])->name('user.ticket'); 
    // RUTE BARU: Profil User
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('user.profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('user.profile.update');
});

// 4. AREA ADMIN (Wajib Login Admin)
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Admin
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.process');
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('logout');

    // Middleware Khusus Admin
    Route::middleware(['auth:admin'])->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard');
        
        // CRUD Event (Create & Store)
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        
        // Verifikasi Pendaftar
        Route::get('/pendaftar', [RegistrasiController::class, 'adminPendaftar'])->name('pendaftar');
        Route::put('/pendaftar/{id}/verifikasi', [RegistrasiController::class, 'verifikasi'])->name('pendaftar.verifikasi');
    });
});