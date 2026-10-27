<?php

use Illuminate\Support\Facades\Route;

// Semua rute ini ditangani secara otomatis oleh Laravel Fortify
Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');