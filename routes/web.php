<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware(['auth'])->group(function() {
    Route::get('/home', function() { return view('home'); })
        ->name('home');

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});

Route::middleware(['guest'])->group(function() {
    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register');
    
    Route::post('/register', [RegisterController::class, 'store']);
    
    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');
    
    Route::post('/login', [LoginController::class, 'store']);
});
