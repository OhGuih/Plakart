<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Piloto;
use App\Models\Campeonato;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index(Request $request)
    {
        // Obtém todos os campeonatos para o filtro
        $campeonatos = Campeonato::all();

        // Filtra as equipes pelo campeonato selecionado
        $equipes = Equipe::with('pilotos', 'campeonato')
            ->when($request->campeonato_id, function ($query, $campeonatoId) {
                return $query->where('campeonato_id', $campeonatoId);
            })
            ->get();

        return view('equipes.index', compact('equipes', 'campeonatos'));
    }

    public function create()
    {
        $campeonatos = Campeonato::all();
        return view('equipes.create', compact('campeonatos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'campeonato_id' => 'required|exists:campeonatos,id',
            'chefe_nome' => 'nullable|string|max:255',
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
            'chefe_nome' => $request->chefe_nome,
        ]);

        // Associando os pilotos à equipe
        $equipe->pilotos()->attach([$piloto1->id, $piloto2->id]);

        return redirect()->route('equipes.index')->with('success', 'Equipe criada com sucesso!');
    }

    public function edit(Equipe $equipe)
    {
        $campeonatos = Campeonato::all();
        return view('equipes.edit', compact('equipe', 'campeonatos'));
    }

    public function update(Request $request, Equipe $equipe)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'campeonato_id' => 'required|exists:campeonatos,id',
            'chefe_nome' => 'nullable|string|max:255',
            'piloto1_nome' => 'required|string|max:255',
            'piloto1_numero' => 'required|integer|unique:pilotos,numero,' . optional($equipe->pilotos[0])->id,
            'piloto2_nome' => 'required|string|max:255',
            'piloto2_numero' => 'required|integer|unique:pilotos,numero,' . optional($equipe->pilotos[1])->id,
        ]);

        // Atualizando os pilotos (se existirem)
        if ($equipe->pilotos->count() > 0) {
            $piloto1 = $equipe->pilotos[0];
            $piloto1->update([
                'nome' => $request->piloto1_nome,
                'numero' => $request->piloto1_numero,
            ]);
        }

        if ($equipe->pilotos->count() > 1) {
            $piloto2 = $equipe->pilotos[1];
            $piloto2->update([
                'nome' => $request->piloto2_nome,
                'numero' => $request->piloto2_numero,
            ]);
        }

        // Atualizando a equipe
        $equipe->update([
            'nome' => $request->nome,
            'campeonato_id' => $request->campeonato_id,
            'chefe_nome' => $request->chefe_nome,
        ]);

        return redirect()->route('equipes.index')->with('success', 'Equipe atualizada com sucesso!');
    }

    public function destroy(Equipe $equipe)
    {
        // Obtém os IDs dos pilotos antes de excluir a equipe
        $pilotoIds = $equipe->pilotos->pluck('id');
    
        // Remove a relação da equipe com os pilotos
        $equipe->pilotos()->detach();
    
        // Exclui os pilotos associados à equipe
        Piloto::whereIn('id', $pilotoIds)->delete();
    
        // Exclui a equipe
        $equipe->delete();
    
        return redirect()->route('equipes.index')->with('success', 'Equipe e seus pilotos excluídos com sucesso!');
    }
    
}
