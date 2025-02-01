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

        Campeonato::create($request->all());

        return redirect()->route('campeonatos.index')->with('success', 'Campeonato criado com sucesso!');
    }
}
