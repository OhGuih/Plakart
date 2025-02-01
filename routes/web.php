<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisaoGeralController;
use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\EquipeController;

Route::resource('campeonatos', CampeonatoController::class);
Route::get('/visao-geral', [VisaoGeralController::class, 'index'])->name('visao.geral');
Route::resource('equipes', EquipeController::class);



Route::get('/', [VisaoGeralController::class, 'index'])->name('home');

