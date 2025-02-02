@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Campeonatos</h1>
    <a href="{{ route('campeonatos.create') }}" class="btn btn-success mb-3">Novo Campeonato</a>

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
