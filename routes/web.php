<?php

use App\Livewire\Booking;
use App\Livewire\History;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::redirect('/dashboard', '/')->name('dashboard');
    Route::get('/booking', Booking::class)->name('booking.index');
    Route::get('/history', History::class)->name('history.index');
});
