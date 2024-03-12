

@extends('layouts.app')
@php 
$promo_products = get_field('promo_product-week', 'option');
$products = get_field('promo_products', 'option');

$args_3 = array(
        'post_type' => 'product',
        'post__in' => $products,
    );
$loop_3 = new WP_Query($args_3);
@endphp 
@section('content')

<section class="archive-aktualnosci__main mb-half lg:mb-full">
    @include('partials.page-header')
    <div class="container">
      <div class="w-full badge text-left py-half lg:py-full text-7xl font-bold relative text-white my-half lg:my-full overflow-hidden"  data-aos="fade-up">
        <div class="bg absolute left-0 z-0 w-full h-full bg-black/30">
            <img class="w-full object-cover object-center mix-blend-luminosity top-1/2 -translate-y-1/2 relative" src="@thumbnail('full')">
            </img>
        </div>
        <div class="relative z-10 px-5 lg:px-10">
            <h1>{!! the_title() !!}</h1>
        </div>
      </div>
      <div class="grid grid-cols-12 gap-4 lg:gap-x-10 mx-auto">
        <div class="col-span-12 lg:col-span-3 lg:-mt-30">
          @include('.woocommerce.partials.sale-of-the-week')
        </div>
        <div class="col-span-12 lg:col-span-9">
          <div class="content wysiwyg">
            @content
          </div>
        </div>
        
      </div>
      <div class="col-span-12 promo-of-the-week__no overflow-hidden mt-30 lg:mt-60">
        @if($loop_3->have_posts())
        <div class="swiperPromo simple-product">
            <div class="w-full text-6xl text-black font-bold lg:mb-60 mb-30 text-center ">
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
        <div class="w-full flex items-center justify-center col-span-full lg:mt-60 mt-30 flex-col sm:flex-row space-y-4 sm:space-y-0 z-10 relative">
            <div class="swiper-nav flex items-center space-x-4">
                @include('sections.home.partials.swiper-arrow', ['class' => "swiperPromo__nav--prev"])
                @include('sections.home.partials.swiper-arrow', ['class' => "swiperPromo__nav--next transform rotate-180"])
            </div>
        </div>
      </div>
    </div>
</section>
 
@endsection


