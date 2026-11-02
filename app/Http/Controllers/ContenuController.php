<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Categorie;


class ContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::with(['categorie', 'auteur'])
            ->latest()
            ->paginate(9);
        return view('contenus.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories  = Categorie::all();
        return view('contenus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $publication = Publication::create([
            'titre' => $request->input('titre'),
            'contenu' => $request->input('contenu'),
            'categorie_id' => $request->input('categorie_id'),
            'user_id' => 1
        ]);

        return redirect()
            ->route('contenus.index', $publication)
            ->with('succes', 'Publication créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        $publication->load(['categorie', 'auteur', 'commentaires.auteur']);
        return view('contenus.show', ['publication' => $publication]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        $categories = Categorie::all();
        return view('contenus.edit', compact('publication', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        $publication->update($request->only('titre', 'contenu', 'categorie_id'));
        return redirect()
            ->route('contenus.index', $publication)
            ->with('succes', 'Publication mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()
            ->route('contenus.index')
            ->with('succes', 'Publication supprimée avec succès.');
    }
}
