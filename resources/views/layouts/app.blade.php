<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta', 'MediaHub — Plateforme de gestion et de diffusion de contenus multimédias.')">
    <title> @yield('titre', 'MediaHub') </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('partials.navigation')

    <main class="conteneur">
        @yield('contenu')
    </main>
    
    @include('partials.pied-de-page')
</body>

</html>