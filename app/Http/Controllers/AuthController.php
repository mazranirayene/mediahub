<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.inscription');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $utilisateur = User::create([
            'name' => $request->validated('nom'),
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
        ]);
        Auth::login($utilisateur);

        return redirect()->route('accueil')
            ->with('succes', 'Bienvenue sur MediaHub !');
    }

    public function showLoginForm()
    {
        return view('auth.connexion');
    }

    public function connecter(Request $request)
    {
        $identifiants = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (! Auth::attempt($identifiants)) {
            return back()->withErrors(['email' => 'Identifiants incorrects.']);
        }
        $request->session()->regenerate();

        return redirect()->intended(route('accueil'));
    }

    public function deconnecter(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('accueil');
    }

    public function creerConnexion()
    {
        return view('auth.connexion');
    }
}
