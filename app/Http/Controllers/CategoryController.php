<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('publications')->paginate(5);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('gerer-categories');

        return view('categories.create');
    }

    public function store(StoreCategorieRequest $request)
    {
        $this->authorize('gerer-categories');
        $categorie = Categorie::create($request->validated());

        return redirect()->route('categories.index')->with('succes', 'Catégorie créée avec succès.');
    }

    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $categorie->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('succes', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Categorie $categorie)
    {
        $this->authorize('gerer-categories');
        if ($categorie->publications()->count() > 0) {
            $nombre = $categorie->publications()->count();

            return redirect()
                ->route('categories.index')
                ->with('erreur', "Impossible de supprimer la catégorie « {$categorie->nom} » : elle est associée à {$nombre} publication(s).");
        }

        $categorie->delete();

        return redirect()
            ->route('categories.index')
            ->with('succes', 'Catégorie supprimée avec succès.');
    }
}
