@extends('layouts.app')

@section('titre', 'Contenus')

@section('contenu')
    <div class="contenus-entete">
        <h1>Contenus multimédias</h1>
        <a class="categories-bouton categories-bouton-principal" href="{{ route('contenus.create') }}">
            + Ajouter un contenu
        </a>
    </div>

    <div class="contenus-grille">
        @forelse ($publications as $publication)
            <x-carte titre="{{ $publication->titre }}">
                <p class="contenu-meta">
                    Catégorie : {{ $publication->categorie->nom }} —
                    Par {{ $publication->auteur->name }} —
                    {{ $publication->created_at->format('d/m/Y') }}
                </p>

                <div class="contenus-actions">
                    <a href="{{ route('contenus.edit', $publication) }}">Modifier</a>

                    <form method="POST" action="{{ route('contenus.destroy', $publication) }}"
                        onsubmit="return confirm('Supprimer la publication « {{ $publication->titre }} » ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            </x-carte>
        @empty
            <p class="contenus-vide">Aucun contenu disponible pour le moment.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination">
        {{ $publications->links() }}
    </div>
@endsection