@extends('layouts.app')

@section('titre', 'Créer une publication')

@section('contenu')
    <div class="contenu-formulaire-page">
        <header class="contenu-formulaire-entete">
            <h1>Créer une publication</h1>
            <p>Renseignez les informations pour ajouter un contenu à MediaHub.</p>
        </header>

        <form class="publication-formulaire" method="POST" action="{{ route('contenus.store') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="publication-champ">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" value="{{ old('titre') }}" @if ($errors->has('titre'))
                aria-invalid="true" aria-describedby="titre-error" @endif>
                @error('titre')
                    <span class="publication-erreur" id="titre-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="publication-champ">
                <label for="contenu">Contenu</label>
                <textarea name="contenu" id="contenu" rows="6" @if ($errors->has('contenu')) aria-invalid="true"
                aria-describedby="contenu-error" @endif>{{ old('contenu') }}</textarea>
                @error('contenu')
                    <span class="publication-erreur" id="contenu-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="publication-champ">
                <label for="categorie_id">Catégorie</label>
                <select name="categorie_id" id="categorie_id" @if ($errors->has('categorie_id')) aria-invalid="true"
                aria-describedby="categorie-error" @endif>
                    <option value="">— Choisir une catégorie —</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_id')
                    <span class="publication-erreur" id="categorie-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="publication-champ">
                <label for="image">Image de couverture</label>
                <input type="file" name="image" id="image" accept="image/*"
                    @if ($errors->has('image')) aria-invalid="true" aria-describedby="image-error" @endif>
                <span class="publication-aide">Formats image acceptés, jusqu’à 2 Mo.</span>
                @error('image')
                    <span class="publication-erreur" id="image-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="publication-champ">
                <label for="fichier_media">Fichier audio ou vidéo</label>
                <input type="file" name="fichier_media" id="fichier_media" accept="audio/*,video/*"
                    @if ($errors->has('fichier_media')) aria-invalid="true" aria-describedby="fichier-media-error" @endif>
                <span class="publication-aide">Formats MP3, WAV ou MP4, jusqu’à 20 Mo.</span>
                @error('fichier_media')
                    <span class="publication-erreur" id="fichier-media-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="publication-formulaire-actions">
                <button class="categories-bouton categories-bouton-principal" type="submit">
                    Créer la publication
                </button>
                <a class="categories-bouton categories-bouton-secondaire" href="{{ route('contenus.index') }}">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection