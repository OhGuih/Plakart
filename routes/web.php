<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisaoGeralController;
use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\EtapaController;

Route::resource('campeonatos', CampeonatoController::class);
Route::get('/visao-geral', [VisaoGeralController::class, 'index'])->name('visao.geral');
Route::resource('equipes', EquipeController::class);
Route::get('/', [VisaoGeralController::class, 'index'])->name('home');

// Rota para a página de gerenciamento de etapas
Route::get('/etapas', [EtapaController::class, 'index'])->name('etapas.index');
Route::post('/etapas', [EtapaController::class, 'store'])->name('etapas.store');
Route::delete('/etapas/{id}', [EtapaController::class, 'destroy'])->name('etapas.destroy');
// Página para definir os resultados da etapa
Route::get('/etapas/{id}/resultados', [EtapaController::class, 'gerenciarPilotos'])->name('etapas.resultados');
// Salva a pontuação dos pilotos na etapa
Route::post('/etapas/salvar-pontuacao', [EtapaController::class, 'salvarPontuacao'])->name('etapas.salvarPontuacao');

