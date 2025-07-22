<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::middleware(['auth'])->group(function() {
    Route::get('/home', function() { return view('home'); })
        ->name('home');

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile/edit', [ProfileController::class, 'update'])
        ->name('profile.update');
    
    Route::get('/notes', [NoteController::class, 'index'])
        ->name('notes.index');

    Route::get('/notes/create', [NoteController::class, 'create'])
        ->name('notes.create');

    Route::post('/notes', [NoteController::class, 'store'])
        ->name('notes.store');

    Route::get('/notes/{note}', [NoteController::class, 'show'])
        ->name('notes.show');

    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])
        ->name('notes.edit');

    Route::put('/notes/{note}', [NoteController::class, 'update'])
        ->name('notes.update');

    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])
        ->name('notes.destroy');

    Route::post('/notes/{note}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    Route::post('/notes/{note}/like', [LikeController::class, 'store'])
        ->name('like.store');
    
    Route::delete('/notes/{note}/like', [LikeController::class, 'destroy'])
        ->name('like.destroy');
});

Route::middleware(['guest'])->group(function() {
    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register');
    
    Route::post('/register', [RegisterController::class, 'store']);
    
    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');
    
    Route::post('/login', [LoginController::class, 'store']);
});
