@extends('layouts.app')

@section('titre', 'Contenus')

@section('contenu')
    <h1>Contenus multimédias</h1>
    @forelse ($publications as $publication)
        <x-carte titre="{{ $publication->titre }}">
            <p>Catégorie : {{ $publication->categorie->nom }} —
                Par {{ $publication->auteur->name }} —
                {{ $publication->created_at->format('d/m/Y') }}
            </p>
        </x-carte>
    @empty
        <p>Aucun contenu disponible pour le moment.</p>
    @endforelse

     {{-- Pagination --}}
    <div class="pagination">
        {{ $publications->links() }}
    </div>
@endsection