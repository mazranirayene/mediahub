<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CategorieResource;


class CategorieController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Categorie::withCount('publications')
            ->orderBy('nom')
            ->get();

        return CategorieResource::collection($categories);
    }
}
