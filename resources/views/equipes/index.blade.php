@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Equipes</h1>
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
                <tr>
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

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let selecionados = document.querySelectorAll('.selecionarEquipe:checked');

                if (selecionados.length === 1) {
                    editarBtn.disabled = false;
                    excluirBtn.disabled = false;
                } else {
                    editarBtn.disabled = true;
                    excluirBtn.disabled = true;
                }
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
    });
</script>

@endsection
