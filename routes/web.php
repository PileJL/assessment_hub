<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/login', 'pages::login')->name('login');
Route::get('/logout', function() {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::livewire('/admin-dashboard', 'pages::admin')->name('admin-dashboard');
});

