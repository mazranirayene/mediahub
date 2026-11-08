<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'contenu' => $this->contenu,
            'categorie' => $this->categorie->nom,
            'auteur' => $this->auteur->nom,
            'image' => $this->image ? Storage::url($this->image) : null,
            'publie_le' => $this->created_at->toDateString(),
        ];
    }
}
