<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Créer une catégorie</title>
</head>

<body>
    <h1>Créer une catégorie</h1>



    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom') }}">
        @error('nom')
            <span style="color: red;">{{ $message }}</span>
        @enderror


        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
            @error('slug')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Creer</button>
    </form>

    <p><a href="{{ route('categories.index') }}">← Retour à la liste</a></p>
</body>

</html>