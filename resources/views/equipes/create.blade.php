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
        <div class="form-group">
            <label for="nome">Nome da Equipe:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="campeonato_id">Campeonato:</label>
            <select name="campeonato_id" id="campeonato_id" class="form-control" required>
                @foreach ($campeonatos as $campeonato)
                <option value="{{ $campeonato->id }}">{{ $campeonato->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="chefe_nome">Nome do Chefe da Equipe (Opcional):</label>
            <input type="text" name="chefe_nome" id="chefe_nome" class="form-control" placeholder="Digite o nome do chefe">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="piloto1_nome">Nome do Piloto 1:</label>
                <input type="text" name="piloto1_nome" id="piloto1_nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="piloto1_numero">Número do Piloto 1:</label>
                <input type="number" name="piloto1_numero" id="piloto1_numero" class="form-control" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="piloto2_nome">Nome do Piloto 2:</label>
                <input type="text" name="piloto2_nome" id="piloto2_nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="piloto2_numero">Número do Piloto 2:</label>
                <input type="number" name="piloto2_numero" id="piloto2_numero" class="form-control" required>
            </div>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
@endsection
