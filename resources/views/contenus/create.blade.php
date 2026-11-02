@extends('layouts.app')

@section('titre', 'Créer une publication')

@section('contenu')
    <h1>Créer une publication</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('contenus.store') }}">
        @csrf

        <div>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre"
                   value="{{ old('titre') }}">
            @error('titre')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" rows="6">{{ old('contenu') }}</textarea>
            @error('contenu')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="categorie_id">Catégorie</label>
            <select name="categorie_id" id="categorie_id">
                <option value="">— Choisir une catégorie —</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}"
                        {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
            @error('categorie_id')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Créer</button>
    </form>

    <p><a href="{{ route('contenus.index') }}">← Retour à la liste</a></p>
@endsection