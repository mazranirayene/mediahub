<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Publication;


class PublicationApiTest extends TestCase
{
    use RefreshDatabase;
    public function test_liste_des_publications_via_api(): void
    {
        Publication::factory()->count(5)->create();
        $reponse = $this->getJson('/api/publications');
        $reponse->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }
    public function test_creation_sans_jeton_est_refusee(): void
    {
        $reponse = $this->postJson('/api/publications', []);
        $reponse->assertStatus(401);
    }
}
