@extends('errors::minimal')

@section('title', __(ucwords('expirado')))
@section('code', '419')
@section('message', __(ucwords('página expirada')))
@section('image')
    <img src="{{ Vite::asset('resources/images/readygradelogoError.webp') }}" class="image" alt="">
@endsection
@section('button')
    <x-button-a class="mt-5" type="button" link="">Ir A La Página De Inicio</x-button-a>
@endsection
