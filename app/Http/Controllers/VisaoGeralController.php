<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use App\Models\Equipe;
use App\Models\Piloto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisaoGeralController extends Controller
{
    public function index(Request $request)
{
    // Obtém o campeonato atual
    $campeonatoAtual = Campeonato::find($request->campeonato_id) ?? Campeonato::latest()->first();

    // Obtém todas as equipes associadas ao campeonato atual
    $equipes = Equipe::with('pilotos')->where('campeonato_id', $campeonatoAtual->id ?? null)->get();

    // Lista de todos os campeonatos para o seletor
    $campeonatos = Campeonato::all();

    // Cálculo de vagas disponíveis
    $totalPilotos = $equipes->sum(fn ($equipe) => $equipe->pilotos->count());
    $limitePilotos = 20;
    $disponiveis = $limitePilotos - $totalPilotos;

    // Obtém a pontuação total dos pilotos no campeonato
    $pontuacao = Piloto::select('pilotos.id', 'pilotos.nome', 'equipes.nome as equipe_nome')
        ->leftJoin('equipe_piloto', 'pilotos.id', '=', 'equipe_piloto.piloto_id')
        ->leftJoin('equipes', 'equipe_piloto.equipe_id', '=', 'equipes.id')
        ->leftJoin('etapa_piloto', 'pilotos.id', '=', 'etapa_piloto.piloto_id')
        ->where('equipes.campeonato_id', $campeonatoAtual->id) // Filtra pelo campeonato atual
        ->selectRaw('pilotos.id, pilotos.nome, equipes.nome as equipe_nome, COALESCE(SUM(etapa_piloto.pontos), 0) as pontos')
        ->groupBy('pilotos.id', 'pilotos.nome', 'equipes.nome')
        ->orderByDesc('pontos')
        ->get();

    return view('visao-geral.index', compact('campeonatoAtual', 'equipes', 'disponiveis', 'campeonatos', 'pontuacao'));
}

}
