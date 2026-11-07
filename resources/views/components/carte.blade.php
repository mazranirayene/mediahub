<div class="carte">
    <h2>
        @if ($enAvant)
            <span class="badge-vedette">⭐ En vedette</span>
        @endif
        {{ $titre }}
    </h2>

    @if ($publication)
        @if ($publication->image)
            <img src="{{ Storage::url($publication->image) }}" alt="{{ $publication->titre }}">
        @endif
        @if ($publication->type_media === 'audio')
            <audio controls src="{{ Storage::url($publication->fichier_media) }}">
            </audio>
        @elseif ($publication->type_media === 'video')
            <video controls src="{{ Storage::url($publication->fichier_media) }}">
            </video>
        @endif
    @endif

    <div class="carte-corps">{{ $slot }}</div>
</div>