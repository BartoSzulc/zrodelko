{{--
  Template Name: Woo Custom Template Promo
  
--}}

@php 
$promo_products = get_field('promo_product-week', 'option');
$products = get_field('promo_products', 'option');

$args_3 = array(
        'post_type' => 'product',
        'post__in' => $products,
    );
$loop_3 = new WP_Query($args_3);
@endphp 
@extends('layouts.app')

@section('content')
  @php
    do_action('woocommerce_before_main_content');
  @endphp
  @include('partials.page-header')
  @if (is_shop())
    @include('partials.categories-boxes')
  @endif
    <div class="container">
    <div class="category__content">
        <div class="grid grid-cols-12 gap-4 mx-auto">
          <div class="col-span-12 xl:col-span-3 mb-10">
            <button id="btn_category_filter" class="btn-primary w-full block lg:hidden mb-5">@php _e('Pokaz filtry', 'atcolor'); @endphp </button>
            <div id="category_filter" class="hidden xl:block category__filter">
              @include('sections.sidebar')
            </div>
            @include('.woocommerce.partials.sale-of-the-week')
          </div>
          <div class="col-span-12 xl:col-span-9 mb-10" id="product-list" >
            @if ($products) 
            @if ($loop_3->have_posts())
                <div class="swiperPromo simple-product">
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
        @endif
          </div>
        </div>
    </div>
  @php
    do_action('woocommerce_after_main_content');
  @endphp 
  @include('.woocommerce.partials.seo-columns')
</div>
@include('sections.home.home-gift-sets')
@include('partials.newsletter')
@endsection
