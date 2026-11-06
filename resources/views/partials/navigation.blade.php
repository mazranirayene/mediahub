<nav class="navigation">
    <a href="{{ route('accueil') }}">MediaHub</a>
    <a href="{{ route('contenus.index') }}">Contenus</a>
    <a class="navigation-bouton{{ request()->routeIs('categories.*') ? ' actif' : '' }}"
        href="{{ route('categories.index') }}" @if (request()->routeIs('categories.*')) aria-current="page" @endif>
        Catégories
    </a>
    <a href="{{ route('a-propos') }}">À propos</a>

    @guest
        <a href="{{ route('connexion') }}">Connexion</a>
        <a href="{{ route('inscription') }}">Inscription</a>
    @endguest
    @auth
        <form method="POST" action="{{ route('deconnexion') }}">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    @endauth
</nav>