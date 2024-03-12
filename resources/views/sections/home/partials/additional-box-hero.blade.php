
@php


   $hero_rep_tiles = $hero_tiles['additional-hero-tiles-repeater'] ?? null;

@endphp
@if (!empty($hero_rep_tiles))
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 col-span-full mt-4">
    @foreach ($hero_rep_tiles as $hero_tile)
    @php
        $link = $hero_tile['hero-tiles-link'] ?? null;
        $image = $hero_tile['hero-tiles-image'] ?? null;
        $desc = $hero_tile['hero-tiles-desc'] ?? null;
    @endphp
    <div class="col-span-1 overflow-hidden">
        @if ($link)
        <a href="{{ $link['url'] }}" class="relative group">
            @if (!empty($image))
            <img class="transition-transform ease-in-out duration-500 group-hover:scale-110 scale aspect-[350/332] w-full lg:w-auto object-center object-cover" src="{{ $image['url'] }}" alt="">
            @endif
            <div class="text absolute top-0 left-0 opacity-0 bg-primary/60 transition ease-in-out duration-500 w-full h-full flex items-center justify-center group-hover:opacity-100">
                <div class="text--inside">
                <div class="btn-secondary">{{ !empty($desc) ? $desc : __("Sprawdź") }}</div>
                </div>
            </div>
        </a>
        @endif
    </div>
    @endforeach
    </div>
@endif