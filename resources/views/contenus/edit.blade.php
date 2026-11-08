@extends('layouts.app')

@section('titre', 'Modifier une publication')

@section('contenu')
    <div class="contenu-formulaire-page">
        <header class="contenu-formulaire-entete">
            <h1>Modifier la publication</h1>
            <p>Mettez à jour les informations de « {{ $publication->titre }} ».</p>
        </header>

        <form class="publication-formulaire" method="POST" action="{{ route('contenus.update', $publication) }}">
            @csrf
            @method('PUT')

            <div class="publication-champ">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre"
                    value="{{ old('titre', $publication->titre) }}"
                    @if ($errors->has('titre')) aria-invalid="true" aria-describedby="titre-error" @endif>
                @error('titre')
                    <span class="publication-erreur" id="titre-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="publication-champ">
                <label for="contenu">Contenu</label>
                <textarea name="contenu" id="contenu" rows="6"
                    @if ($errors->has('contenu')) aria-invalid="true" aria-describedby="contenu-error" @endif>{{ old('contenu', $publication->contenu) }}</textarea>
                @error('contenu')
                    <span class="publication-erreur" id="contenu-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="publication-champ">
                <label for="categorie_id">Catégorie</label>
                <select name="categorie_id" id="categorie_id"
                    @if ($errors->has('categorie_id')) aria-invalid="true" aria-describedby="categorie-error" @endif>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}"
                            {{ old('categorie_id', $publication->categorie_id) == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <span class="publication-erreur" id="categorie-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="publication-formulaire-actions">
                <button class="categories-bouton categories-bouton-principal" type="submit">
                    Enregistrer les modifications
                </button>
                <a class="categories-bouton categories-bouton-secondaire" href="{{ route('contenus.index') }}">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection
