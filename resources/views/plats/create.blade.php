<!-- resources/views/plats/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crea un nuovo piatto</h1>

        <form action="{{ route('plats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nome del Piatto -->
            <div class="form-group">
                <label for="name">Nome del Piatto</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <!-- Ricetta del Piatto -->
            <div class="form-group">
                <label for="recette">Ricetta</label>
                <textarea id="recette" name="recette" class="form-control" required></textarea>
            </div>

            <!-- Immagine del Piatto -->
            <div class="form-group">
                <label for="image">Carica un'immagine</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>

            <!-- Pulsante per inviare il modulo -->
            <button type="submit" class="btn btn-primary">Salva Piatto</button>
        </form>
    </div>
@endsection
