@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Equipe</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('equipes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Equipe:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="campeonato_id" class="form-label">Campeonato:</label>
            <select name="campeonato_id" id="campeonato_id" class="form-control" required>
                @foreach ($campeonatos as $campeonato)
                <option value="{{ $campeonato->id }}">{{ $campeonato->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="chefe_nome">Nome do Chefe da Equipe (Opcional)</label>
            <input type="text" name="chefe_nome" id="chefe_nome" class="form-control" placeholder="Digite o nome do chefe">
        </div>


        <div class="mb-3">
            <label for="piloto1_nome" class="form-label">Nome do Piloto 1:</label>
            <input type="text" name="piloto1_nome" id="piloto1_nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="piloto1_numero" class="form-label">Número do Piloto 1:</label>
            <input type="number" name="piloto1_numero" id="piloto1_numero" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="piloto2_nome" class="form-label">Nome do Piloto 2:</label>
            <input type="text" name="piloto2_nome" id="piloto2_nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="piloto2_numero" class="form-label">Número do Piloto 2:</label>
            <input type="number" name="piloto2_numero" id="piloto2_numero" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection