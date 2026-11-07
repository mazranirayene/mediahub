<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContenusIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_renders_publication_media(): void
    {
        $category = Categorie::create([
            'nom' => 'Actualités',
            'slug' => 'actualites',
        ]);
        $author = User::factory()->create();
        $publication = Publication::create([
            'titre' => 'Une publication',
            'contenu' => 'Contenu de test',
            'categorie_id' => $category->id,
            'user_id' => $author->id,
            'image' => 'publications/couverture.jpg',
            'fichier_media' => 'medias/reportage.mp4',
            'type_media' => 'video',
        ]);

        $response = $this->get(route('contenus.index'));

        $response->assertOk();
        $response->assertSee($publication->titre);
        $response->assertSee('src="/storage/publications/couverture.jpg"', false);
        $response->assertSee('<video controls src="/storage/medias/reportage.mp4">', false);
    }
}
