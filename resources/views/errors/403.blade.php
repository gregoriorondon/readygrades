@extends('errors::minimal')

@section('title', ucwords('no esta autorizado'))
@section('code', '403')
@section('message', ucwords('usted no está autorizado'))
@section('image')
    <img src="{{ Vite::asset('resources/images/403.webp') }}" class="image">
@endsection
@section('button')
    <x-button class="mt-5" type="button" onclick="history.back()">Regresar</x-button>
@endsection
