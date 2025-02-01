<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Piloto;
use App\Models\Campeonato;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index()
    {
        $equipes = Equipe::with('pilotos', 'chefe', 'campeonato')->get();
        return view('equipes.index', compact('equipes'));
    }

    public function create()
    {
        $campeonatos = Campeonato::all();
        $pilotos = Piloto::all();
        return view('equipes.create', compact('campeonatos', 'pilotos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'campeonato_id' => 'required|exists:campeonatos,id',
            'chefe_id' => 'nullable|exists:pilotos,id',
            'piloto1_nome' => 'required|string|max:255',
            'piloto1_numero' => 'required|integer|unique:pilotos,numero',
            'piloto2_nome' => 'required|string|max:255',
            'piloto2_numero' => 'required|integer|unique:pilotos,numero',
        ]);

        // Criando os pilotos
        $piloto1 = Piloto::create([
            'nome' => $request->piloto1_nome,
            'numero' => $request->piloto1_numero,
        ]);

        $piloto2 = Piloto::create([
            'nome' => $request->piloto2_nome,
            'numero' => $request->piloto2_numero,
        ]);

        // Criando a equipe
        $equipe = Equipe::create([
            'nome' => $request->nome,
            'campeonato_id' => $request->campeonato_id,
            'chefe_id' => $request->chefe_id,
        ]);

        // Associando os pilotos à equipe
        $equipe->pilotos()->attach([$piloto1->id, $piloto2->id]);

        return redirect()->route('equipes.index')->with('success', 'Equipe criada com sucesso!');
    }
}
