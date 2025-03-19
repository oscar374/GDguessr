<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home'); 

Route::get('/game', function () {
    return view('game');
})->name('game'); 

Route::get('/sCode', function () {
    return view('sCode');
})->name('sCode'); 