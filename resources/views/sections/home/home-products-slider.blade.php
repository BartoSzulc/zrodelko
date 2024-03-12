@php
$args = array(
   'post_type' => 'product',
   'posts_per_page' => 8,
   'orderby' => 'date',
   'order' => 'DESC',
   'tax_query' => array(
       array(
           'taxonomy' => 'product_cat',
           'field'    => 'slug',
           'terms'    => 'zestawy-upominkowe',
           'operator' => 'NOT IN',
       ),
   ),
);
$loop = new WP_Query($args);

$args_2 = array(
   'post_type' => 'product',
   'posts_per_page' => 8,
   'meta_key' => 'total_sales',
   'orderby' => 'meta_value_num',
   'order' => 'DESC',
   'tax_query' => array(
       array(
           'taxonomy' => 'product_cat',
           'field'    => 'slug',
           'terms'    => 'zestawy-upominkowe',
           'operator' => 'NOT IN',
       ),
   ),
);
$loop_2 = new WP_Query($args_2);
@endphp

<section class="home-products-slider__newest-and-bestsellers lg:mb-60 mb-30">
    <div class="container">
       <div class="tabs">
          <ul class="tab-links list-none flex items-center justify-center w-full text-center">
             <li class="active"><a href="#tab1">{!! __('Nowości') !!}</a></li>
             <li><a href="#tab2">{!! __('Bestsellery') !!}</a></li>
          </ul>
          <div class="tab-content">
             <div id="tab1" class="tab active">
                @if ($loop->have_posts())
                <div class="swiperNewest simple-product">
                  <div class="swiper-wrapper">
                     @while ($loop->have_posts())
                        @php
                           $loop->the_post();
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
                <div class="w-full flex items-center justify-between lg:mt-60 mt-30 flex-col sm:flex-row space-y-30 sm:space-y-0">
                  <div class="swiper-nav flex items-center space-x-4">
                     @include('sections.home.partials.swiper-arrow', ['class' => "swiperNewest__nav--prev"])
                     @include('sections.home.partials.swiper-arrow', ['class' => "swiperNewest__nav--next transform rotate-180"])
                  </div>
                  <div class="see-all__button">
                     <a href="{{ home_url('/nowosci/') }}" class="btn-secondary">{!! __('Zobacz wszystkie') !!}</a>
                  </div>
               </div>
             </div>
             <div id="tab2" class="tab">
                 @if ($loop_2->have_posts())
                 <div class="swiperBestsellers simple-product">
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
                <div class="w-full flex items-center justify-between lg:mt-60 mt-30 flex-col sm:flex-row space-y-30 sm:space-y-0">
                  <div class="swiper-nav flex items-center space-x-4">
                     @include('sections.home.partials.swiper-arrow', ['class' => "swiperBestsellers__nav--prev"])
                     @include('sections.home.partials.swiper-arrow', ['class' => "swiperBestsellers__nav--next transform rotate-180"])
                  </div>
                  <div class="see-all__button">
                     <a href="{{ home_url('/bestsellery/') }}" class="btn-secondary">{!! __('Zobacz wszystkie') !!}</a>
                  </div>
               </div>
             </div>
          </div>
       </div>
    </div>
 </section>