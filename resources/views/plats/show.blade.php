<!-- resources/views/plats/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $plat->name }}</h1>

        <!-- Visualizza l'immagine del piatto -->
        <img src="{{ asset('storage/' . $plat->image) }}" alt="{{ $plat->name }}" class="img-fluid">

        <p><strong>Ricetta:</strong> {{ $plat->recette }}</p>

        <a href="{{ route('plats.index') }}" class="btn btn-secondary">Torna alla lista</a>
    </div>
@endsection
