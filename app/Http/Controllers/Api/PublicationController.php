<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PublicationResource;
use App\Models\Publication;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $publications = Publication::with(['categorie', 'auteur'])
            ->when($request->filled('categorie_id'), function ($query) use ($request) {
                $query->where('categorie_id', $request->integer('categorie_id'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();  

        return PublicationResource::collection($publications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $publication = Publication::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);
        return (new PublicationResource($publication))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        return new PublicationResource(
            $publication->load('categorie', 'auteur')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdatePublicationRequest $request,
        Publication $publication
    ) {
        $this->authorize('update', $publication);
        $publication->update($request->validated());
        return new PublicationResource($publication);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        $this->authorize('delete', $publication);
        $publication->delete();
        return response()->json(null, 204);
    }
}
