<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::redirect('/dashboard', '/')->name('dashboard');
});
