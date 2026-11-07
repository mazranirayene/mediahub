@extends('layouts.app')

@section('titre', 'Liste des catégories')

@section('contenu')
    <div class="categories-entete">
        <div>
            <h1>Catégories</h1>
            <p>Organisez vos publications en un seul endroit.</p>
        </div>
        @can('gerer-categories')
            <a class="categories-bouton categories-bouton-principal" href="{{ route('categories.create') }}">
                + Créer une catégorie
            </a>
        @endcan
    </div>

    @if ($categories->isEmpty())
        <p class="categories-vide">Aucune catégorie pour le moment. Créez-en une pour commencer.</p>
    @else
        <ul class="categories-liste">
            @foreach ($categories as $categorie)
                <li class="categorie-carte">
                    <div class="categorie-infos">
                        <h2>{{ $categorie->nom }}</h2>
                        <span class="categorie-slug">{{ $categorie->slug }}</span>
                    </div>

                    <div class="categorie-actions">
                        @can('gerer-categories')
                            <a class="categories-bouton categories-bouton-secondaire" href="{{ route('categories.edit', $categorie) }}">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('categories.destroy', $categorie) }}"
                                onsubmit="return confirm('Supprimer la catégorie « {{ $categorie->nom }} » ?');">
                                @csrf
                                @method('DELETE')
                                <button class="categories-bouton categories-bouton-danger" type="submit">
                                    Supprimer
                                </button>
                            </form>
                        @endcan
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection