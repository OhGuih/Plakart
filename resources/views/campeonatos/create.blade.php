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
    }

    h1 {
        font-size: 2rem;
        color:rgb(17, 127, 230);
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

    .btn-primary {
        background-color:rgb(17, 127, 230);
        border-color:rgb(17, 127, 230);
        padding: 10px 15px;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color:rgb(17, 127, 230);
        border-color: #ac2925;
    }
</style>

<div class="container">
    <h1>Cadastrar Campeonato</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('campeonatos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Campeonato:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="etapas" class="form-label">Número de Etapas (1 a 16):</label>
            <input type="number" name="etapas" id="etapas" class="form-control" min="1" max="16" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
