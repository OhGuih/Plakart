@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gerenciamento de Etapas</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('etapas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="campeonato_id" class="form-label">Campeonato</label>
            <select class="form-control" name="campeonato_id" id="campeonato_select" required>
                <option value="">Selecione um campeonato</option>
                @foreach($campeonatos as $campeonato)
                    <option value="{{ $campeonato->id }}" data-max-etapas="{{ $campeonato->etapas }}">{{ $campeonato->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Etapa</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="numero" class="form-label">Número da Etapa</label>
            <input type="number" class="form-control" name="numero" id="numero_etapa" required>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data da Etapa</label>
            <input type="date" class="form-control" name="data">
        </div>
        <button type="submit" class="btn btn-primary">Salvar Etapa</button>
    </form>

    <h2 class="mt-4">Etapas Cadastradas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Campeonato</th>
                <th>Nome</th>
                <th>Número</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="etapas_table">
            @foreach($etapas as $etapa)
                <tr data-campeonato="{{ $etapa->campeonato_id }}">
                    <td>{{ $etapa->id }}</td>
                    <td>{{ $etapa->campeonato->nome }}</td>
                    <td>{{ $etapa->nome }}</td>
                    <td>{{ $etapa->numero }}</td>
                    <td>{{ $etapa->data }}</td>
                    <td>
                        <form action="{{ route('etapas.destroy', $etapa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta etapa?');">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('campeonato_select').addEventListener('change', function() {
        let selectedCampeonato = this.value;
        let maxEtapas = this.options[this.selectedIndex].getAttribute('data-max-etapas');
        let numeroEtapaInput = document.getElementById('numero_etapa');
        numeroEtapaInput.setAttribute('max', maxEtapas);
        numeroEtapaInput.setAttribute('min', 1);
        numeroEtapaInput.value = '';
        
        document.querySelectorAll('#etapas_table tr').forEach(row => {
            if (selectedCampeonato === '' || row.getAttribute('data-campeonato') === selectedCampeonato) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
