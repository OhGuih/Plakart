@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">PLAKART</h1>
    
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
</div>

<script>
    document.getElementById('selecionarCampeonato').addEventListener('change', function() {
        window.location.href = this.value;
    });
</script>
@endsection
