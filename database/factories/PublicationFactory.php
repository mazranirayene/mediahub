<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(6),
            'contenu' => fake()->paragraphs(3, true),
            'categorie_id' => Categorie::inRandomOrder()->first()->id,
            'user_id' => User::factory(),
        ];
    }
}
