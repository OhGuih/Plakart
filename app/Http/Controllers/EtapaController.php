<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use App\Models\Campeonato;
use App\Models\Piloto;
use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtapaController extends Controller
{
    // Exibe a página de gerenciamento de etapas
    public function index()
    {
        $campeonatos = Campeonato::all();
        $etapas = Etapa::with(['campeonato', 'pilotos'])->get(); // Carregar os pilotos relacionados
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

    // Exclui uma etapa
    public function destroy($id)
    {
        $etapa = Etapa::findOrFail($id);
        $etapa->delete();

        return redirect()->back()->with('success', 'Etapa excluída com sucesso!');
    }

    // Exibe a página de alocação de pilotos para uma etapa específica
    public function gerenciarPilotos($id)
    {
        $etapa = Etapa::with('campeonato')->findOrFail($id);

        $pilotos = Piloto::whereHas('equipe', function ($query) use ($etapa) {
            $query->where('campeonato_id', $etapa->campeonato_id);
        })->get();

        return view('etapas.gerenciar_pilotos', compact('etapa', 'pilotos'));
    }

    // Salva a pontuação dos pilotos para uma etapa
    public function salvarPontuacao(Request $request)
    {
        $request->validate([
            'etapa_id' => 'required|exists:etapas,id',
            'resultados' => 'required|array', // Lista de pilotos e posições
        ]);

        $pontosSistemaF1 = [25, 18, 15, 12, 10, 8, 6, 4, 2, 1];

        foreach ($request->resultados as $index => $pilotoId) {
            DB::table('etapa_piloto')->updateOrInsert(
                ['etapa_id' => $request->etapa_id, 'piloto_id' => $pilotoId],
                ['posicao' => $index + 1, 'pontos' => $pontosSistemaF1[$index] ?? 0]
            );
        }

        return redirect()->route('etapas.index')->with('success', 'Pontuação salva com sucesso!');
    }
}
