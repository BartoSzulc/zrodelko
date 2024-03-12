
@php 

@endphp

<div class="absolute bg-white w-full w-calc h-full z-0 top-0 background-white hidden lg:block"></div>
@if ($products) 
    @if ($loop_3->have_posts())
        <div class="swiperPromo simple-product">
            <div class="w-full text-6xl text-black font-bold lg:mb-60 mb-30 text-center lg:text-left">
                <h2>{!! __('Produkty w dobrej cenie ') !!}</h2>
            </div>
            <div class="swiper-wrapper">
                @while ($loop_3->have_posts())

                    @php
                    $loop_3->the_post();
                    global $product;
                    @endphp
                        <div class="swiper-slide">
                        @php wc_get_template_part( 'content', 'product' ); @endphp
                        </div>
                @endwhile
            </div>
        </div>
    @endif
    @php
    wp_reset_postdata();
    @endphp
@else
    @if($loop_2->have_posts())
    <div class="swiperPromo simple-product">
        <div class="w-full text-6xl text-black font-bold lg:mb-60 mb-30 text-center lg:text-left">
            <h2>{!! __('Produkty w dobrej cenie ') !!}</h2>
        </div>
        <div class="swiper-wrapper">
            @while ($loop_2->have_posts())
                @php
                $loop_2->the_post();
                global $product;
                @endphp
                    <div class="swiper-slide">
                    @php wc_get_template_part( 'content', 'product' ); @endphp
                    </div>
            @endwhile
        </div>
    </div>
    @endif
    @php
    wp_reset_postdata();
    @endphp
@endif
