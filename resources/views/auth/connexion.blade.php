@extends('layouts.app')

@section('titre', 'Connexion')

@section('contenu')
<div class="container">
    <h1>Connexion</h1>

    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('connexion.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email"
                   name="email"
                   id="email"
                   value="{{ old('email') }}"
                   class="@error('email') is-invalid @enderror"
                   required
                   autofocus>
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

        <button type="submit">Se connecter</button>
    </form>

    <p>
        Pas encore de compte ?
        <a href="{{ route('inscription') }}">S'inscrire</a>
    </p>
</div>
@endsection