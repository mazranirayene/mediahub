@extends('layouts.app')

@section('titee', 'Inscription')

@section('contenu')
<div class="container">
    <h1>Créer un compte</h1>

    @if (session('succes'))
        <div class="alert alert-success">
            {{ session('succes') }}
        </div>
    @endif

    <form action="{{ route('inscription.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text"
                   name="nom"
                   id="nom"
                   value="{{ old('nom') }}"
                   class="@error('nom') is-invalid @enderror"
                   required
                   autofocus>
            @error('nom')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email"
                   name="email"
                   id="email"
                   value="{{ old('email') }}"
                   class="@error('email') is-invalid @enderror"
                   required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password"
                   name="password"
                   id="password"
                   class="@error('password') is-invalid @enderror"
                   required>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   required>
        </div>

        <button type="submit">S'inscrire</button>
    </form>

    <p>
        Déjà un compte ?
        <a href="{{ route('connexion') }}">Se connecter</a>
    </p>
</div>
@endsection