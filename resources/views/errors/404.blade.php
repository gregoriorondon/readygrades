@extends('errors::minimal')

@section('title', __(ucwords('no encontrado')))
@section('code', '404')
@section('message', __(ucwords('página no encontrada')))
@section('image')
    <img src="{{ Vite::asset('resources/images/readygradelogoError.webp') }}" class="image" alt="">
@endsection
@section('button')
    <x-button class="mt-5" type="button" onclick="history.back()">Regresar</x-button>
@endsection
