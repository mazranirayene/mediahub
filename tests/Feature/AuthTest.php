<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Publication;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function test_un_utilisateur_peut_sinscrire(): void
    {
        $reponse = $this->post('/inscription', [
            'nom' => 'Amel',
            'email' => 'amel@exemple.com',
            'password' => 'motdepasse',
            'password_confirmation' => 'motdepasse',
        ]);
        $reponse->assertRedirect('/');
        $this->assertAuthenticated();
    }
    public function test_connexion_avec_identifiants_incorrects(): void
    {
        $reponse = $this->post('/connexion', [
            'email' => 'inconnu@exemple.com',
            'password' => 'faux',
        ]);
        $reponse->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_un_auteur_peut_modifier_sa_propre_publication(): void
    {
        $auteur = User::factory()->create();
        $publication = Publication::factory()->create(['user_id' => $auteur->id]);
        $reponse = $this->actingAs($auteur)
            ->put("/contenus/{$publication->id}", [
                'titre' => 'Titre modifié',
                'contenu' => str_repeat('a', 30),
                'categorie_id' => $publication->categorie_id,
            ]);
        $reponse->assertRedirect("/contenus/{$publication->id}");
    }

}
