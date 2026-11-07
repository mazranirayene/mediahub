@extends('layouts.app')

@section('titre', 'Connexion')

@section('contenu')
<section class="auth-page">
    <header class="auth-entete">
        <span class="auth-sur-titre">Ravi de vous revoir</span>
        <h1>Connexion</h1>
        <p>Connectez-vous pour retrouver et partager vos contenus.</p>
    </header>

    @if (session('status'))
        <div class="auth-alerte auth-alerte-info" role="status">
            {{ session('status') }}
        </div>
    @endif

    <form class="auth-formulaire" action="{{ route('connexion.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email"
                   name="email"
                   id="email"
                   value="{{ old('email') }}"
                   class="@error('email') is-invalid @enderror"
                   @if ($errors->has('email')) aria-invalid="true" aria-describedby="email-error" @endif
                   required
                   autofocus>
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

        <button class="auth-bouton" type="submit">Se connecter</button>
    </form>

    <p class="auth-pied">
        Pas encore de compte ?
        <a href="{{ route('inscription') }}">S'inscrire</a>
    </p>
</section>
@endsection