@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection


@section('contenido')

{{-- si se deja así /> el componente no va soportar slots --}}
    <x-listar-post :posts="$posts" />

@endsection