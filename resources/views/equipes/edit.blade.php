@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Equipe</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipes.update', $equipe->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Equipe:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ $equipe->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="campeonato_id" class="form-label">Campeonato:</label>
            <select id="campeonato_id" name="campeonato_id" class="form-control">
                @foreach($campeonatos as $campeonato)
                    <option value="{{ $campeonato->id }}" {{ $equipe->campeonato_id == $campeonato->id ? 'selected' : '' }}>
                        {{ $campeonato->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="chefe_nome" class="form-label">Chefe da Equipe:</label>
            <input type="text" id="chefe_nome" name="chefe_nome" class="form-control" value="{{ $equipe->chefe_nome }}">
        </div>

        <div class="mb-3">
            <label for="piloto1_nome" class="form-label">Piloto 1:</label>
            <input type="text" id="piloto1_nome" name="piloto1_nome" class="form-control" value="{{ $equipe->pilotos[0]->nome ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="piloto1_numero" class="form-label">Número do Piloto 1:</label>
            <input type="number" id="piloto1_numero" name="piloto1_numero" class="form-control" value="{{ $equipe->pilotos[0]->numero ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="piloto2_nome" class="form-label">Piloto 2:</label>
            <input type="text" id="piloto2_nome" name="piloto2_nome" class="form-control" value="{{ $equipe->pilotos[1]->nome ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="piloto2_numero" class="form-label">Número do Piloto 2:</label>
            <input type="number" id="piloto2_numero" name="piloto2_numero" class="form-control" value="{{ $equipe->pilotos[1]->numero ?? '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('equipes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
