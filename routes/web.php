<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')
    ->name('home');

Route::resource('login', \App\Http\Controllers\Auth\LoginController::class)
    ->only(['index', 'store']);

Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');

Route::resource('register', \App\Http\Controllers\Auth\RegisterController::class)
    ->only(['index', 'store']);


Route::controller(\App\Http\Controllers\Auth\VerifyController::class)
    ->prefix('verify')
    ->name('verify.')
    ->group(function () {
        Route::get('email/{id}', 'email')
            ->middleware('signed')
            ->name('email');;
    });
