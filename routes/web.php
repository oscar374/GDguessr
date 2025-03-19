<?php

use App\Http\Controllers\pointerCrateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home'); 

Route::get('/gamemode', function () {
    return view('gamemode');
})->name('gamemode'); 

Route::get('/game', function () {
    return view('game');
})->name('game');

Route::get('/sCode', function () {
    return view('sCode');
})->name('sCode');          

Route::get('/game', [pointerCrateController::class, 'getApiData']);