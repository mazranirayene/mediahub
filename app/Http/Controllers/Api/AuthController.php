<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function connecter(Request $request)
    {
        $identifiants = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (!Auth::attempt($identifiants)) {
            return response()->json(
                ['message' => 'Identifiants incorrects.'],
                401
            );
        }
        $utilisateur = Auth::user();
        $jeton = $utilisateur->createToken('api')->plainTextToken;
        return response()->json(['token' => $jeton]);
    }
}
