<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home')->name('home');

Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'pages::login')->name('login');
    Route::livewire('/onboarding', 'pages::onboarding')->name('onboarding');
});

Route::middleware('auth')->group(function () {
    Route::name('account.')->group(function () {
        Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard');
        Route::livewire('/elections', 'pages::elections')->name('elections');
        Route::livewire('/elections/{election}', 'pages::elections-details')->name('elections.details');
        Route::livewire('/vote/{election}', 'pages::vote')->name('vote');
        Route::livewire('/results/{election}', 'pages::election-results')->name('results');
    });

    Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::livewire('/dashboard', 'pages::admin-dashboard')->name('dashboard');
        Route::livewire('/elections', 'pages::admin-elections')->name('elections');
        Route::livewire('/elections/{election}/candidates', 'pages::admin-candidates')->name('elections.candidates');
        Route::livewire('/voters', 'pages::admin-voters')->name('voters');
        Route::livewire('/results', 'pages::admin-results')->name('results');
    });
});

Route::livewire('/logout', 'pages::logout')->name('logout');