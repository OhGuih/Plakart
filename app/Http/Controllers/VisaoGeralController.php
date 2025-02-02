<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use App\Models\Equipe;
use Illuminate\Http\Request;

class VisaoGeralController extends Controller
{
    public function index(Request $request)
{
    // Pega o campeonato selecionado pelo usuário ou o mais recente
    $campeonatoAtual = Campeonato::find($request->campeonato_id) ?? Campeonato::latest()->first();

    // Obtém todas as equipes associadas ao campeonato atual
    $equipes = Equipe::with('pilotos')->where('campeonato_id', $campeonatoAtual->id ?? null)->get();

    // Lista de todos os campeonatos para o seletor
    $campeonatos = Campeonato::all();

    // Cálculo de vagas disponíveis
    $totalPilotos = $equipes->sum(fn ($equipe) => $equipe->pilotos->count());
    $limitePilotos = 20;
    $disponiveis = $limitePilotos - $totalPilotos;

    return view('visao-geral.index', compact('campeonatoAtual', 'equipes', 'disponiveis', 'campeonatos'));
}

}

