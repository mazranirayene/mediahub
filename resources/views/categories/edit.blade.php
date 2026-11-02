<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier une catégorie</title>
</head>

<body>
    <h1>Modifier la catégorie #{{ $categorie->id }}</h1>


    <form method="POST" action="{{ route('categories.update', $categorie) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $categorie->nom) }}">
            @error('nom')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $categorie->slug) }}">
            @error('slug')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Upload</button>
    </form>

    <p><a href="{{ route('categories.index') }}">← Retour à la liste</a></p>
</body>

</html>