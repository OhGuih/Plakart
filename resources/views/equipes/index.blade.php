@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Equipes</h1>
    <a href="{{ route('equipes.create') }}" class="btn btn-success mb-3">Nova Equipe</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Campeonato</th>
                <th>Chefe</th>
                <th>Pilotos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipes as $equipe)
                <tr>
                    <td>{{ $equipe->nome }}</td>
                    <td>{{ $equipe->campeonato->nome }}</td>
                    <td>{{ $equipe->chefe->nome ?? 'Sem chefe' }}</td>
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
@endsection
