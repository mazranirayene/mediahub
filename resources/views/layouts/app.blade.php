<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="@yield('meta', 'MediaHub — Plateforme de gestion et de diffusion de contenus multimédias.')">
    <title> @yield('titre', 'MediaHub') </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('partials.navigation')

    <main class="conteneur">

        @if (session('succes'))
            <div class="alerte alerte-succes">{{ session('succes') }}</div>
        @endif

        @yield('contenu')

        @if (session('erreur'))
            <div class="alert alert-danger"
                style="color: red; background: #f8d7da; padding: 10px; margin: 10px 0; border: 1px solid #f5c6cb;">
                {{ session('erreur') }}
            </div>
        @endif
        
    </main>

    @include('partials.pied-de-page')
</body>

</html>