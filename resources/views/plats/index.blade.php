<!-- resources/views/plats/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista dei Piatti</h1>

        <!-- Ciclo per visualizzare tutti i piatti -->
        @foreach($plats as $plat)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $plat->image) }}" class="card-img-top" alt="{{ $plat->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $plat->name }}</h5>
                    <p class="card-text">{{ $plat->recette }}</p>
                    <a href="{{ route('plats.show', $plat->id) }}" class="btn btn-primary">Visualizza</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
