<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'nom' => 'Vidéo', 
                'slug' => 'video',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Audio', 
                'slug' => 'audio',
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'nom' => 'Image', 
                'slug' => 'image',
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);
    }
}
