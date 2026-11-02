@extends('layouts.app')

@section('titre', 'Contenus')

@section('contenu')
    <h1>Contenus multimédias</h1>

    @forelse ($publications as $publication)
        <x-carte titre="{{ $publication->titre }}">
            <p>Catégorie : {{ $publication->categorie->nom }} —
                Par {{ $publication->auteur }} —
                {{ $publication->created_at->format('d/m/Y') }}
            </p>

            {{-- Liens d'action --}}
            <a href="{{ route('contenus.edit', $publication) }}">Modifier</a>

            <form method="POST" action="{{ route('contenus.destroy', $publication) }}" style="display: inline;"
                onsubmit="return confirm('Supprimer la publication « {{ $publication->titre }} » ?');">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
        </x-carte>
    @empty
        <p>Aucun contenu disponible pour le moment.</p>
    @endforelse

    {{-- Pagination --}}
    <div class="pagination">
        {{ $publications->links() }}
    </div>
@endsection