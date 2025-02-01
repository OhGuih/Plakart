@extends('layouts.app')

@section('content')
    <h2>Editar Campeonato</h2>

    <form action="{{ route('campeonatos.update', $campeonato->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Campeonato:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="etapas" class="form-label">Número de Etapas (1 a 16):</label>
            <input type="number" name="etapas" id="etapas" class="form-control" min="1" max="16" required>
        </div>

        <button type="submit">Salvar Alterações</button>
    </form>

    <form action="{{ route('campeonatos.destroy', $campeonato->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
</form>

@endsection
