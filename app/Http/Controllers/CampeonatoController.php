<?php

namespace App\Http\Controllers;

use App\Models\Campeonato;
use Illuminate\Http\Request;

class CampeonatoController extends Controller
{
    public function index()
    {
        $campeonatos = Campeonato::all();
        return view('campeonatos.index', compact('campeonatos'));
    }

    public function create()
    {
        return view('campeonatos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'etapas' => 'required|integer|min:1|max:16',
        ]);

        Campeonato::create($request->only(['nome', 'etapas']));

        return redirect()->route('campeonatos.index')->with('success', 'Campeonato criado com sucesso!');
    }

    public function edit($id)
    {
        $campeonato = Campeonato::findOrFail($id);
        return view('campeonatos.edit', compact('campeonato'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'etapas' => 'required|integer|min:1|max:16',
        ]);

        $campeonato = Campeonato::findOrFail($id);
        $campeonato->update($request->only(['nome', 'etapas']));

        return redirect()->route('campeonatos.index')->with('success', 'Campeonato atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $campeonato = Campeonato::findOrFail($id);
        $campeonato->delete();

        return redirect()->route('campeonatos.index')->with('success', 'Campeonato excluído com sucesso!');
    }
}
