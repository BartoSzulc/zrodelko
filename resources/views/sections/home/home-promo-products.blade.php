@php

    $promo_products = get_field('promo_product-week', 'option');

    if ($promo_products) :
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 1,
            'post__in'       => $promo_products,
        );
        $loop = new WP_Query($args);
    endif;

    $args_2 = array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 8,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => 'zestawy-upominkowe',
                'operator' => 'NOT IN',
            ),
        ),
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'     => '_sale_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'NUMERIC',
            ),
            array(
                'key'     => '_regular_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'NUMERIC',
            ),
        ),
        'orderby'        => 'price',

    );


    $loop_2 = new WP_Query($args_2);
    
    $products = get_field('promo_products', 'option');

    $args_3 = array(
            'post_type' => 'product',
            'post__in' => $products,
        );
    $loop_3 = new WP_Query($args_3);


    
@endphp


@if ($loop_2->have_posts())
<section class="home-promo-products lg:pt-60 pt-30 relative w-full z-10 overflow-hidden">
    <div class="container">
       <div class="grid grid-cols-12 gap-4">
                @php
                    $product_count = $loop_2->found_posts;
                @endphp
                @if ($promo_products)
                    @if ($loop->have_posts())
                        <div class="lg:col-span-4 col-span-full grid grid-cols-4 gap-x-4 relative z-10">
                            <div class="col-span-4 lg:mb-60 mb-30">
                                <div class="w-full text-6xl text-black font-bold text-center lg:text-left">
                                    <h2>{!! __('<span class="text-primary">Oferta</span> tygodnia') !!}</h2>
                                </div>
                            </div>
                            <div class="promo-product simple-product mb-30 lg:mb-0">
                                @while ($loop->have_posts())
                                    @php
                                    $loop->the_post();
                                    global $product;
                                    @endphp
                                    <div class="promo-product__inside">
                                        @php wc_get_template_part( 'content', 'product' ); @endphp
                                    </div>
                                    {!! do_shortcode('[sale_countdown]') !!}
                                @endwhile
                            </div>
                        </div>
                        <div class="lg:col-span-8 col-span-full promo-of-the-week__yes relative lg:static ">
                            <div class="col-span-1 flex items-center justify-end relative z-10">
                                @include('sections.home.partials.swiper-arrow', ['class' => "swiperPromo__nav--prev hidden lg:block"])
                            </div>
                            @include('sections.home.partials.promo-products')
                            <div class="swiper-nav lg:hidden flex items-center justify-center space-x-4 relative z-10 mt-30">
                                @include('sections.home.partials.swiper-arrow', ['class' => "swiperPromo__nav--prev--mobile"])
                                @include('sections.home.partials.swiper-arrow', ['class' => "swiperPromo__nav--next--mobile transform rotate-180"])
                            </div>
                            <div class="col-span-1 flex items-center justify-start relative z-10">
                                @include('sections.home.partials.swiper-arrow', ['class' => "swiperPromo__nav--next transform rotate-180 hidden lg:block"])
                            </div>
                        
                        </div>
                    @endif
                @else 
                        <div class="col-span-12 promo-of-the-week__no lg:pb-60 pb-30">
                            @include('sections.home.partials.promo-products')
                            <div class="w-full flex items-center justify-center col-span-full lg:mt-60 mt-30 flex-col sm:flex-row space-y-4 sm:space-y-0 z-10 relative">
                                <div class="swiper-nav flex items-center space-x-4">
                                    @include('sections.home.partials.swiper-arrow', ['class' => "swiperPromo__nav--prev"])
                                    @include('sections.home.partials.swiper-arrow', ['class' => "swiperPromo__nav--next transform rotate-180"])
                                </div>
                            </div>
                        </div>
                @endif
                @php
                wp_reset_postdata();
                @endphp
       </div>
    </div>
</section>
@endif;