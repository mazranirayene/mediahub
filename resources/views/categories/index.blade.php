@extends('layouts.app')

@section('titre', 'Liste des catégories')

@section('contenu')
    <h1>Liste des catégories</h1>

    <p><a href="{{ route('categories.create') }}">+ Créer une catégorie</a></p>

    @if ($categories->isEmpty())
        <p>Aucune catégorie pour le moment.</p>
    @else
        <ul>
            @foreach ($categories as $categorie)
                <li>
                    <strong>{{ $categorie->nom }}</strong>
                    <em>({{ $categorie->slug }})</em>

                    {{-- Lien Modifier --}}
                    <a href="{{ route('categories.edit', $categorie) }}">Modifier</a>

                    {{-- Bouton Supprimer --}}
                    <form method="POST"
                          action="{{ route('categories.destroy', $categorie) }}"
                          style="display: inline;"
                          onsubmit="return confirm('Supprimer la catégorie « {{ $categorie->nom }} » ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection