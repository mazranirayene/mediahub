<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CategorieTest extends TestCase
{
    use RefreshDatabase;
    public function test_creation_dune_categorie_par_un_admin(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $reponse = $this->actingAs($admin)->post('/categories', [
            'nom' => 'Podcast',
            'slug' => 'podcast',
        ]);
        $reponse->assertRedirect('/categories');
        $this->assertDatabaseHas('categories', ['slug' => 'podcast']);
    }
}
