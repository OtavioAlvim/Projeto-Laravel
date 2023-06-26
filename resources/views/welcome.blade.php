@extends('layouts.main')

@section('title', 'Pagina inicial')

@section('content')

    <div id="serch-container" class="col-md-12">
        <h1>Busque um evento</h1>
        <form action="/" method="get">
            <input type="text" name="search" id="search" class="form-control" placeholder="Procurar...">
        </form>
    </div>
    <div id="events-container" class="col-md-12">
        @if ($search)
            <h2>Procurando por : {{$search}}</h2>
            <p class="subtitle">Veja os eventos dos proxímos dias</p>
            @else
            <h2>Proximos Eventos</h2>
            <p class="subtitle">Veja os eventos dos proxímos dias</p>
        @endif

        <div id="cards-container" class="row">
            @if (count($events) == 0 && $search)
                <p>Não foi possivel encontrar nenhum evento com : {{$search}}</p>
            @elseif (count($events) == 0)
            <p>Nenhum evento registrado!</p>
            @endif

            @foreach ($events as $events)
                <div class="card col-md-3">
                    <img src="/img/events/{{ $events->image }}" alt="{{ $events->title }}">
                    <div class="card-body">
                        <div class="card-date">{{date('d/m/Y',strtotime($events->date))}}</div>
                        <h5 class="card-title">{{ $events->title }}</h5>
                        <p class="card-particupants"><i class="icon ion-md-contacts"></i> Participantes</p>
                        <a href="/events/{{ $events->id }}" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- @foreach ($events as $events)
<p>{{$events->title}} -- {{$events->description}}</p>
@endforeach --}}

    {{-- comentario com blade --}}

@endsection
