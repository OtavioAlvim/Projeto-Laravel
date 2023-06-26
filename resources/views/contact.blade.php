@extends('layouts.main')

@section('title','Contact')

@section('content')
{{-- <h1>{{$teste}}</h1> --}}

@foreach ($contact as $contact)
    <p>{{$contact->name}}</p>
@endforeach
@endsection

