<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::livewire('/', 'pages::home')->name('home');

Route::middleware(['guest'])->group(function () {
    Route::livewire('/login', 'pages::login')->name('login');
});

Route::middleware(['auth'])->group(function() {
    Route::livewire('/admin-dashboard', 'pages::admin')->name('admin-dashboard');
    
    Route::get('/logout', function() {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
});

