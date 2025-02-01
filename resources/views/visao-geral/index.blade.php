@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">PLAKART</h1>
    
    <div class="text-center">
        <a href="{{ route('campeonatos.index') }}" class="btn btn-secondary">Campeonato</a>
        <a href="{{ route('visao.geral') }}" class="btn btn-primary">Visão Geral</a>
        <a href="{{ route('campeonatos.create') }}" class="btn btn-secondary">Cadastro</a>
    </div>

    <h3 class="mt-4 text-center">
        CAMPEONATO ATUAL: {{ $campeonatoAtual->nome ?? 'Nenhum Campeonato' }}
    </h3>

    <p class="text-center"><strong>CADASTROS DE PILOTOS DISPONÍVEIS:</strong> {{ $disponiveis }} / 20</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>1º Piloto</th>
                <th>2º Piloto</th>
                <th>Chefe da Equipe</th>
                <th>Equipe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipes as $equipe)
                <tr>
                    <td>{{ $equipe->pilotos[0]->nome ?? '' }}</td>
                    <td>{{ $equipe->pilotos[1]->nome ?? '' }}</td>
                    <td>{{ $equipe->chefe->nome ?? 'Sem chefe' }}</td>
                    <td>{{ $equipe->nome }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
