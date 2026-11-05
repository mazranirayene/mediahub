@extends('layouts.app')

@section('titre', 'Modifier une catégorie')

@section('contenu')
    <div class="categories-formulaire-page">
        <header class="categories-formulaire-entete">
            <h1>Modifier une catégorie</h1>
            <p>Mettez à jour le nom ou le slug de « {{ $categorie->nom }} ».</p>
        </header>

        <form class="categorie-formulaire" method="POST" action="{{ route('categories.update', $categorie) }}">
            @csrf
            @method('PUT')

            <div class="categorie-champ">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $categorie->nom) }}"
                    @if ($errors->has('nom')) aria-invalid="true" aria-describedby="nom-error" @endif>
                @error('nom')
                    <span class="categorie-erreur" id="nom-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="categorie-champ">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $categorie->slug) }}"
                    @if ($errors->has('slug')) aria-invalid="true" aria-describedby="slug-error" @endif>
                @error('slug')
                    <span class="categorie-erreur" id="slug-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="categorie-formulaire-actions">
                <button class="categories-bouton categories-bouton-principal" type="submit">
                    Enregistrer les modifications
                </button>
                <a class="categories-bouton categories-bouton-secondaire"
                    href="{{ route('categories.index') }}">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection