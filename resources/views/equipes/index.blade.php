@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Equipes</h1>

    <!-- Selecionar Campeonato -->
    <div class="mb-3">
        <label for="campeonatoFiltro"><strong>Selecionar Campeonato:</strong></label>
        <select id="campeonatoFiltro" class="form-control d-inline-block w-auto">
            <option value="">Todos</option>
            @foreach ($campeonatos as $campeonato)
                <option value="{{ $campeonato->id }}" {{ request('campeonato_id') == $campeonato->id ? 'selected' : '' }}>
                    {{ $campeonato->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <a href="{{ route('equipes.create') }}" class="btn btn-success mb-3">Nova Equipe</a>
    
    <button id="editarEquipe" class="btn btn-warning mb-3" disabled>Editar</button>
    <button id="excluirEquipe" class="btn btn-danger mb-3" disabled>Excluir</button>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th></th> <!-- Checkbox para seleção -->
                <th>Nome</th>
                <th>Campeonato</th>
                <th>Chefe</th>
                <th>Pilotos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipes as $equipe)
                <tr data-campeonato="{{ $equipe->campeonato->id }}">
                    <td>
                        <input type="checkbox" class="selecionarEquipe" value="{{ $equipe->id }}">
                    </td>
                    <td>{{ $equipe->nome }}</td>
                    <td>{{ $equipe->campeonato->nome }}</td>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let checkboxes = document.querySelectorAll('.selecionarEquipe');
        let editarBtn = document.getElementById('editarEquipe');
        let excluirBtn = document.getElementById('excluirEquipe');
        let campeonatoFiltro = document.getElementById('campeonatoFiltro');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let selecionados = document.querySelectorAll('.selecionarEquipe:checked');

                editarBtn.disabled = selecionados.length !== 1;
                excluirBtn.disabled = selecionados.length !== 1;
            });
        });

        editarBtn.addEventListener('click', function() {
            let selecionado = document.querySelector('.selecionarEquipe:checked');
            if (selecionado) {
                window.location.href = `/equipes/${selecionado.value}/edit`;
            }
        });

        excluirBtn.addEventListener('click', function() {
            let selecionado = document.querySelector('.selecionarEquipe:checked');
            if (selecionado) {
                if (confirm("Tem certeza que deseja excluir esta equipe?")) {
                    fetch(`/equipes/${selecionado.value}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => {
                        if (response.ok) {
                            window.location.reload();
                        }
                    });
                }
            }
        });

        // Filtrar equipes pelo campeonato selecionado
        campeonatoFiltro.addEventListener('change', function() {
            let campeonatoId = this.value;
            let rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                if (campeonatoId === "" || row.getAttribute('data-campeonato') === campeonatoId) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>

@endsection
