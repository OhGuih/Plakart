<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use App\Models\Campeonato;
use Illuminate\Http\Request;

class EtapaController extends Controller
{
    // Exibe a página de gerenciamento de etapas
    public function index()
    {
        $campeonatos = Campeonato::all();
        $etapas = Etapa::with('campeonato')->get();
        return view('etapas.index', compact('campeonatos', 'etapas'));
    }

    // Salva uma nova etapa
    public function store(Request $request)
    {
        $request->validate([
            'campeonato_id' => 'required|exists:campeonatos,id',
            'nome' => 'required|string|max:255',
            'numero' => 'required|integer',
            'data' => 'nullable|date',
        ]);
    
        // Verifica se já existe uma etapa com esse número no mesmo campeonato
        $etapaExistente = Etapa::where('campeonato_id', $request->campeonato_id)
                                ->where('numero', $request->numero)
                                ->exists();
    
        if ($etapaExistente) {
            return redirect()->back()->with('error', 'Já existe uma etapa com esse número para este campeonato.');
        }
    
        // Criar a etapa se não existir conflito
        Etapa::create($request->all());
    
        return redirect()->back()->with('success', 'Etapa cadastrada com sucesso!');
    }
    

    public function destroy($id)
    {
        $etapa = Etapa::findOrFail($id);
        $etapa->delete();

        return redirect()->back()->with('successo', 'Etapa excluída com sucesso!');
    }
}
