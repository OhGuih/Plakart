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

    h1 {
        font-size: 2rem;
        color: rgb(99, 138, 245);
        text-align: center;
    }

    select {
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    .table {
        margin-top: 20px;
    }

    .table th {
        background-color: rgb(17, 127, 230);
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
    <h1>PLAKART</h1>
    
    <div class="text-center mt-4">
        <h3>CAMPEONATO ATUAL:
            <select id="selecionarCampeonato" class="form-select d-inline w-auto">
                @foreach ($campeonatos as $camp)
                    <option value="{{ route('visao.geral', ['campeonato_id' => $camp->id]) }}"
                        {{ $camp->id == ($campeonatoAtual->id ?? null) ? 'selected' : '' }}>
                        {{ $camp->nome }}
                    </option>
                @endforeach
            </select>
        </h3>
    </div>

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
                    <td>{{ $equipe->pilotos[0]->nome ?? 'Sem piloto' }}</td>
                    <td>{{ $equipe->pilotos[1]->nome ?? 'Sem piloto' }}</td>
                    <td>{{ $equipe->chefe_nome ?? 'Sem chefe' }}</td>
                    <td>{{ $equipe->nome }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="mt-4 text-center">Pontuação do Campeonato</h3>
    <div class="text-center">
       
    </div>

    <table class="table table-bordered mt-3" id="tabelaPontuacao">
        <thead>
            <tr>
                <th>Posição</th>
                <th>Piloto</th>
                <th>Equipe</th>
                <th>Pontos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pontuacao as $posicao => $piloto)
                <tr>
                    <td>{{ $posicao + 1 }}</td>
                    <td>{{ $piloto->nome }}</td>
                    <td>{{ $piloto->equipe->first()->nome ?? 'Sem equipe' }}</td>
                    <td>{{ $piloto->pontos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('selecionarCampeonato').addEventListener('change', function() {
        window.location.href = this.value;
    });

    document.getElementById('selecionarPontuacao').addEventListener('change', function() {
        let tipo = this.value;
        let url = tipo === 'geral' ? "{{ route('visao.geral', ['campeonato_id' => $campeonatoAtual->id]) }}" : "{{ route('visao.geral', ['campeonato_id' => $campeonatoAtual->id, 'etapa' => 'selecionada']) }}";
        window.location.href = url;
    });
</script>
@endsection
