<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\CommentController;
use Illuminate\Support\Facades\Route;

// Show registration and login forms
Route::view('register', 'auth.register')->name('register.form');
Route::view('login', 'auth.login')->name('login.form');

// Process registration and login
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'loadAllPost'])->name('home');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::put('/comment/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::get('/comment/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
});
