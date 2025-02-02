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
        max-width: 800px;
        margin: auto;
    }

    h1 {
        font-size: 2rem;
        color: #d9534f;
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-row .form-group {
        flex: 1;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .btn-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 10px;
    }

    .btn-primary {
        background-color:rgb(0, 134, 94);
        border-color:rgb(202, 202, 202);
        padding: 10px 15px;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color:rgb(0, 196, 42);
        border-color:rgb(122, 224, 82);
    }
</style>

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

        <div class="form-group">
            <label for="nome">Nome da Equipe:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ $equipe->nome }}" required>
        </div>

        <div class="form-group">
            <label for="campeonato_id">Campeonato:</label>
            <select id="campeonato_id" name="campeonato_id" class="form-control">
                @foreach($campeonatos as $campeonato)
                    <option value="{{ $campeonato->id }}" {{ $equipe->campeonato_id == $campeonato->id ? 'selected' : '' }}>
                        {{ $campeonato->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="chefe_nome">Chefe da Equipe:</label>
            <input type="text" id="chefe_nome" name="chefe_nome" class="form-control" value="{{ $equipe->chefe_nome }}">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="piloto1_nome">Piloto 1:</label>
                <input type="text" id="piloto1_nome" name="piloto1_nome" class="form-control" value="{{ $equipe->pilotos[0]->nome ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="piloto1_numero">Número do Piloto 1:</label>
                <input type="number" id="piloto1_numero" name="piloto1_numero" class="form-control" value="{{ $equipe->pilotos[0]->numero ?? '' }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="piloto2_nome">Piloto 2:</label>
                <input type="text" id="piloto2_nome" name="piloto2_nome" class="form-control" value="{{ $equipe->pilotos[1]->nome ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="piloto2_numero">Número do Piloto 2:</label>
                <input type="number" id="piloto2_numero" name="piloto2_numero" class="form-control" value="{{ $equipe->pilotos[1]->numero ?? '' }}" required>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('equipes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
