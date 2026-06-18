<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::get('notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('notes/{id}', [NoteController::class, 'show'])->name('notes.show');
    Route::post('notes', [NoteController::class, 'store'])->name('notes.store');
});

require __DIR__.'/settings.php';
