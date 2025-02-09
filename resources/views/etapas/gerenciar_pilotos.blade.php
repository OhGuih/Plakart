@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gerenciar Pilotos para a Etapa: {{ $etapa->nome }}</h1>
    <h4>Campeonato: {{ $etapa->campeonato->nome }}</h4>

    <form action="{{ route('etapas.salvarPontuacao') }}" method="POST">
        @csrf
        <input type="hidden" name="etapa_id" value="{{ $etapa->id }}">

        <h3>Ordem de Chegada </h3>
        <h6>Arraste. Clique em algum piloto e arraste para a posição de chegada para definir</h6>
        <a> </a>
        <ul id="pilotos-lista" class="list-group">
            @foreach($pilotos as $piloto)
                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $piloto->id }}">
                    <span>{{ $piloto->nome }} (Nº {{ $piloto->numero }})</span>
                    <input type="hidden" name="resultados[]" value="{{ $piloto->id }}">
                </li>
            @endforeach
        </ul>

        <button type="submit" class="btn btn-primary mt-3">Salvar Resultados</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    let lista = document.getElementById("pilotos-lista");
    new Sortable(lista, {
        animation: 150,
        ghostClass: "sortable-ghost",
        onEnd: function (evt) {
            let inputs = document.querySelectorAll("input[name='resultados[]']");
            let items = document.querySelectorAll("#pilotos-lista li");
            
            items.forEach((item, index) => {
                inputs[index].value = item.getAttribute("data-id");
            });
        }
    });
</script>
@endsection
