@extends('layouts.main')

@section('title','Pagina inicial')

@section('content')
    
    <h1>HOME SCREEN</h1>
    <img src="/img/banner_2.jpg" alt="">
    @if(10 > 5)
        <p>The condicion is true</p>
    @endif
    <p>{{$name}}</p>

    @if($name == 'Pedro')
        <p>The name is Pedro</p>
    @else
        <p>The name is {{$name}}, I'm {{$age}} years old</p>
        <p>Job as {{$job}}</p>
    @endif

    @for($i = 0; $i < count($arr); $i++)
        <p>{{$arr[$i]}} - {{$i}}</p>
        @if($i == 2)
            <p>O i é 2</p>
        @endif
    @endfor

    @foreach ($names as $names)
        <p>{{$loop->index}}
        {{-- </p>imprime os idices do array --}}
        <p>{{$names}}</p>
    @endforeach
    {{--comentario com blade--}}

    @endsection