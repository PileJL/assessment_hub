<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/applicant', 'pages::applicant')->name('applicant');

Route::middleware(['guest'])->group(function () {
    Route::livewire('/login', 'pages::login')->name('login');
});

Route::middleware(['auth'])->group(function() {
    Route::livewire('/admin-dashboard', 'pages::admin.index')->name('admin-dashboard');
    Route::livewire('/admin-dashboard/create', 'pages::admin.create')->name('admin-dashboard.create');
    Route::livewire('/admin-dashboard/{applicant}/edit', 'pages::admin.edit')->name('admin-dashboard.edit');
    
    Route::get('/logout', function() {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
});

