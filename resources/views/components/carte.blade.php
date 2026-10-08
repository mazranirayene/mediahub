<div class="carte">
    <h2>
        @if ($enAvant)
            <span class="badge-vedette">⭐ En vedette</span>
        @endif
        {{ $titre }}
    </h2>
    <div class="carte-corps">{{ $slot }}</div>
</div>