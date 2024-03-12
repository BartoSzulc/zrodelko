
@php

   $hero_tiles = get_field('hero-tiles');

   $tiles = get_field('tiles-repeater');

   //hero
   $version = $hero_tiles['hero-title_1--version'] ?? null;
   $hero_tile_1 = $hero_tiles['hero-tile_1'] ?? null;
   $hero_rep_tiles = $hero_tiles['hero-tiles-repeater'] ?? null;
   $hero_rep_tiles_1 = $hero_tiles['hero-tiles-repeater_1'] ?? null;
@endphp

<section class="home-hero-slider relative lg:pt-60 pt-30 bg-white">
    <div class="container">
       <div class="grid grid-flow-col grid-cols-12 gap-x-4 gap-y-4 lg:gap-y-0">
         @if ($version === 'full')
            @if (!empty($hero_tile_1))
            <div class="lg:row-span-2 lg:col-span-6 col-span-full overflow-hidden">
               @if ($hero_tile_1['hero-tiles-link']['url'])
               <a href="{{ $hero_tile_1['hero-tiles-link']['url'] }}" class="relative group">
                  @if (!empty($hero_tile_1['hero-tiles-image']))
                  <img class="transition-transform ease-in-out duration-500 group-hover:scale-110 scale aspect-[716/680] w-full lg:w-auto object-center object-cover" src="{{ $hero_tile_1['hero-tiles-image']['url'] }}" alt="">
                  @endif
                  <div class="text absolute top-0 left-0 opacity-0 bg-primary/60 transition ease-in-out duration-500 w-full h-full flex items-center justify-center group-hover:opacity-100">
                     <div class="text--inside">
                        <div class="btn-secondary">{{ !empty($hero_tile_1['hero-tiles-title']) ? $title : __("Sprawdź") }}</div>
                     </div>
                  </div>
               </a>
               @endif
            </div>
            @endif
          @else
            @if (!empty($hero_rep_tiles_1))
               <div class="lg:col-span-6 grid grid-cols-6 gap-4 col-span-full">
               @foreach ($hero_rep_tiles_1 as $hero_tile_1)
               @php
                  $link_1 = $hero_tile_1['hero-tiles-link'] ?? null;
                  $image_1 = $hero_tile_1['hero-tiles-image'] ?? null;
                  $desc_1 = $hero_tile_1['hero-tiles-desc'] ?? null;
               @endphp
               <div class="sm:col-span-3 col-span-full overflow-hidden">
                  @if ($link_1)
                  <a href="{{ $link_1['url'] }}" class="relative group">
                     @if (!empty($image_1))
                     <img class="transition-transform ease-in-out duration-500 group-hover:scale-110 scale aspect-[350/332] w-full lg:w-auto object-center object-cover" src="{{$image_1['url'] }}" alt="">
                     @endif
                     <div class="text absolute top-0 left-0 opacity-0 bg-primary/60 transition ease-in-out duration-500 w-full h-full flex items-center justify-center group-hover:opacity-100">
                        <div class="text--inside">
                           <div class="btn-secondary">{{ !empty($desc_1) ? $desc_1 : __("Sprawdź") }}</div>
                        </div>
                     </div>
                  </a>
                  @endif
               </div>
               @endforeach
            </div>
            @endif
          @endif
          @if (!empty($hero_rep_tiles))
            <div class="lg:col-span-6 grid grid-cols-6 gap-4 col-span-full">
            @foreach ($hero_rep_tiles as $hero_tile)
            @php
               $link = $hero_tile['hero-tiles-link'] ?? null;
               $image = $hero_tile['hero-tiles-image'] ?? null;
               $desc = $hero_tile['hero-tiles-desc'] ?? null;
            @endphp
            <div class="sm:col-span-3 col-span-full overflow-hidden">
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
          
       </div>
       @include('sections.home.partials.additional-box-hero')
    </div>
   @if (!empty($tiles))
   <div class="home-information lg:py-60 py-30">
     <div class="container">
        <div class="grid lg:grid-cols-4 grid-cols-2  gap-4">
            @foreach ($tiles as $tile)
            @php
               $tile_image = $tile['tiles-image'] ?? null;
               $tile_desc = $tile['tiles-desc'] ?? null;
            @endphp
           <div class="col-span-1 column flex flex-col sm:flex-row items-center sm:space-x-30 text-center sm:text-left space-y-4 sm:space-y-0" data-aos="fade-up">
               @if (!empty($tile_image))
               <div class="image">
                  <img src="{{ $tile_image['url'] }}" alt="">
               </div>
               @endif
               @if (!empty($tile_desc))
               <div class="text lg:text-desc text-base font-medium">
                  {!! $tile_desc !!}
               </div>
               @endif
           </div>
           @endforeach
        </div>
     </div>
   </div>
   @endif
</section>