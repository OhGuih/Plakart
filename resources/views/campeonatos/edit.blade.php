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
        text-align: center;
    }

    h2 {
        font-size: 2rem;
        color: #d9534f;
        text-align: center;
    }

    .campeonato-nome {
        font-size: 1.2rem;
        color: red;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    label {
        font-weight: bold;
    }

    .form-control {
        padding: 10px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .btn-container {
        display: flex;
        justify-content: center;
        gap: 20px;
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
    <h2>Editar Campeonato</h2>
    <span class="campeonato-nome">{{ $campeonato->nome }}</span>

    {{-- Formulário de Edição --}}
    <form action="{{ route('campeonatos.update', $campeonato->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Campeonato:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $campeonato->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="etapas" class="form-label">Número de Etapas (1 a 16):</label>
            <select name="etapas" id="etapas" class="form-control" required>
                @for ($i = 1; $i <= 16; $i++)
                    <option value="{{ $i }}" {{ $campeonato->etapas == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>

    {{-- Formulário de Exclusão - Agora separado --}}
    <form action="{{ route('campeonatos.destroy', $campeonato->id) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
    </form>
</div>
@endsection
