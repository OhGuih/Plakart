<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use App\Models\Equipe;
use Illuminate\Http\Request;

class VisaoGeralController extends Controller
{
    public function index()
    {
        $campeonatoAtual = Campeonato::latest()->first();
        $equipes = Equipe::with('pilotos', 'chefe')->get();

        $totalPilotos = $equipes->sum(fn ($equipe) => $equipe->pilotos->count());
        $limitePilotos = 20;
        $disponiveis = $limitePilotos - $totalPilotos;

        return view('visao-geral.index', compact('campeonatoAtual', 'equipes', 'disponiveis'));
    }
}

