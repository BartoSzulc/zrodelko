<!--- slider -->
@if(!empty($images))

  <!-- Swiper -->
  <div class="swiper-parent-container relative">
    
    <div class="swiper-container gallery-top service swiper" id="gallery-top">
      @if(count($images) > 0)
      <div class="absolute h-full top-0 left-4 flex items-center z-[20] ">
        @include('sections.home.partials.swiper-arrow', ['class' => "swiperBestsellers__nav--next transform swiper-arrow-right h-6 w-6 flex items-center"])
      </div>
      @endif
      <div class="swiper-wrapper">
        @if (has_post_thumbnail($product->get_id()))
          @php
              $image_id = get_post_thumbnail_id($product->get_id());
              $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
              $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
          @endphp
          <div class="swiper-slide swiper-slide-top  border text-center flex items-center justify-center">
            <a class="glightbox" href="{{$image_url}}" title="{{$image_alt}}" >
              <img src="{{ esc_url($image_url) }}" alt="{{ esc_attr($image_alt) }}">
              <div class="absolute bottom-2 right-2 pointer-events-none">
                <div class="text-smallest text-primary/50">
                  <span>Zdjęcie poglądowe</span>
                </div>
              </div>
            </a>
          </div>
        
        @endif
        @php foreach( $images as $image ): @endphp
        <div class="swiper-slide swiper-slide-top  border text-center flex items-center justify-center">
          <a class="glightbox" href="{{$image['url']}}" >
            <img src="{{$image['url']}}" alt="{{$image['title']}}"/>
            <div class="absolute bottom-2 right-2 pointer-events-none">
              <div class="text-smallest text-primary/50">
                <span>Zdjęcie poglądowe</span>
              </div>
            </div>
          </a>
        </div>

        @php endforeach; @endphp
      </div>
      @if(count($images) > 0)
      <div class="absolute h-full top-0 right-4 flex items-center z-[20]">
        @include('sections.home.partials.swiper-arrow', ['class' => "swiperBestsellers__nav--next transform rotate-180 swiper-arrow-right h-6 w-6 flex items-center "])
      </div>
    @endif
    </div>
   
    @if(count($images) > 0)
      <div class="swiper-container gallery-thumbs swiper mt-3">
        <div class="swiper-wrapper">
          @if (has_post_thumbnail($product->get_id()))
          @php
              $image_id = get_post_thumbnail_id($product->get_id());
              $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
              $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
          @endphp
          <div class="swiper-slide swiper-slide-thumb  border text-center  py-4 xs:py-5">
            <img class="inline-block object-contain aspect-[2/1]" src="{{ esc_url($image_url) }}" alt="{{ esc_attr($image_alt) }}">

          </div>
        
          @endif
          @php foreach( $images as $image ): @endphp
          <div class="swiper-slide swiper-slide-thumb  border text-center  py-4 xs:py-5">
            <img class="inline-block object-contain aspect-[2/1]" src="{{$image['url']}}" alt="{{$image['title']}}"/>
          </div>

          @php endforeach; @endphp
        </div>
      </div>
    @endif
  </div>
@else
  <div class="image">
    @if (has_post_thumbnail($product->get_id()))
    @php
      $image_id = get_post_thumbnail_id($product->get_id());
      $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
      $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    @endphp
    <a class="glightbox" href="{{$image_url}}" title="{{$image_alt}}" >
      <img src="{{ esc_url($image_url) }}" alt="{{ esc_attr($image_alt) }}">
    </a>
    @endif
    <div class="absolute bottom-2 right-2 pointer-events-none">
      <div class="text-smallest text-primary/50">
        <span>Zdjęcie poglądowe</span>
      </div>
    </div>
  </div>
@endif
