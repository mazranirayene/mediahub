<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('publications')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $categorie = Categorie::create($request->only('nom', 'slug'));
        return redirect()->route('categories.index')->with('succes', 'Catégorie créée avec succès.');
    }

    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $categorie->update($request->only('nom', 'slug'));
        return redirect()
            ->route('categories.index')
            ->with('succes', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()
            ->route('categories.index')
            ->with('succes', 'Catégorie supprimée avec succès.');
    }
}
