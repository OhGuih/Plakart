@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
    }

    .container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        max-width: 900px;
        margin: auto;
    }

    h1, h2 {
        font-size: 2rem;
        color:rgb(17, 127, 230);
    }

    .btn {
        padding: 8px 12px;
        font-size: 1rem;
    }

    .table {
        margin-top: 20px;
    }

    .table th {
        background-color:rgb(17, 127, 230);
        color: white;
        text-align: center;
    }

    .table td {
        text-align: center;
        background-color: #fff;
        padding: 10px;
    }

    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tr:hover {
        background-color: #f1f1f1;
    }
</style>

<div class="container">
    <h1>Lista de Campeonatos</h1>
    <a href="{{ route('campeonatos.create') }}" class="btn btn-success mb-3">Novo Campeonato</a>
    <a href="{{ route('etapas.index') }}" class="btn btn-success mb-3">Gerenciar alguma Etapa</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Etapas</th>
                <th>Equipes</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($campeonatos as $campeonato)
                <tr>
                    <td>{{ $campeonato->id }}</td>
                    <td>
                        <a href="?campeonato_id={{ $campeonato->id }}">{{ $campeonato->nome }}</a>
                    </td>
                    <td>{{ $campeonato->etapas }}</td>
                    <td>{{ $campeonato->equipes->count() }}</td>
                    <td>
                        <a href="{{ route('campeonatos.edit', $campeonato->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('campeonatos.destroy', $campeonato->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(request('campeonato_id'))
        @php
            $campeonatoSelecionado = $campeonatos->find(request('campeonato_id'));
        @endphp

        @if($campeonatoSelecionado)
            <h2 class="mt-4">Equipes do Campeonato: {{ $campeonatoSelecionado->nome }}</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Chefe</th>
                        <th>Pilotos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campeonatoSelecionado->equipes as $equipe)
                        <tr>
                            <td>{{ $equipe->nome }}</td>
                            <td>{{ $equipe->chefe_nome ?? 'Sem chefe' }}</td>
                            <td>
                                @foreach ($equipe->pilotos as $piloto)
                                    {{ $piloto->nome }}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="mt-4">Nenhum campeonato encontrado.</p>
        @endif
    @endif
</div>
@endsection
