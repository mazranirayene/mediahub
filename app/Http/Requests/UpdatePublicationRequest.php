<?php

namespace App\Http\Requests;

use App\Models\Publication;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePublicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $publication = $this->route('publication');

        return $publication instanceof Publication
            && ($this->user()?->can('update', $publication) ?? false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string|min:20',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|file|image|max:2048',
            'fichier_media' => 'nullable|file|mimes:mp3,mp4,wav|max:20480',
        ];
    }
}
