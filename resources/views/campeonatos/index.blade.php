@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Campeonatos</h1>
    <a href="{{ route('campeonatos.create') }}" class="btn btn-success mb-3">Novo Campeonato</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Etapas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($campeonatos as $campeonato)
                <tr>
                    <td>{{ $campeonato->id }}</td>
                    <td>{{ $campeonato->nome }}</td>
                    <td>{{ $campeonato->etapas }}</td>
                    <td>
                        <a href="{{ route('campeonatos.edit', $campeonato->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('campeonatos.destroy', $campeonato->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
