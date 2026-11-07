@extends('layouts.app')

@section('titre', 'Inscription')

@section('contenu')
<section class="auth-page">
    <header class="auth-entete">
        <span class="auth-sur-titre">Rejoignez MediaHub</span>
        <h1>Créer un compte</h1>
        <p>Inscrivez-vous pour publier et découvrir des contenus multimédias.</p>
    </header>

    @if (session('succes'))
        <div class="auth-alerte auth-alerte-succes" role="status">
            {{ session('succes') }}
        </div>
    @endif

    <form class="auth-formulaire" action="{{ route('inscription.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text"
                   name="nom"
                   id="nom"
                   value="{{ old('nom') }}"
                   class="@error('nom') is-invalid @enderror"
                   @if ($errors->has('nom')) aria-invalid="true" aria-describedby="nom-error" @endif
                   required
                   autofocus>
            @error('nom')
                <span class="error" id="nom-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email"
                   name="email"
                   id="email"
                   value="{{ old('email') }}"
                   class="@error('email') is-invalid @enderror"
                   @if ($errors->has('email')) aria-invalid="true" aria-describedby="email-error" @endif
                   required>
            @error('email')
                <span class="error" id="email-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password"
                   name="password"
                   id="password"
                   class="@error('password') is-invalid @enderror"
                   @if ($errors->has('password')) aria-invalid="true" aria-describedby="password-error" @endif
                   required>
            @error('password')
                <span class="error" id="password-error" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   required>
        </div>

        <button class="auth-bouton" type="submit">Créer mon compte</button>
    </form>

    <p class="auth-pied">
        Déjà un compte ?
        <a href="{{ route('connexion') }}">Se connecter</a>
    </p>
</section>
@endsection