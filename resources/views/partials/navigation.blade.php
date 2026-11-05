<nav class="navigation">
    <a href="{{ route('accueil') }}">MediaHub</a>
    <a href="{{ route('contenus.index') }}">Contenus</a>
    <a class="navigation-bouton{{ request()->routeIs('categories.*') ? ' actif' : '' }}"
        href="{{ route('categories.index') }}"
        @if (request()->routeIs('categories.*')) aria-current="page" @endif>
        Catégories
    </a>
    <a href="{{ route('a-propos') }}">À propos</a>
</nav>