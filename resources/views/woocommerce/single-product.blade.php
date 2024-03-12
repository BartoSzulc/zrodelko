@php
$subtitle = get_field('subtitle');
$extra_cost = get_field('extra-cost');
$images = get_field('product_gallery');
$product_shipping_time = get_field('product_shipping_time');
$product_document = get_field('product_document');
$show_promo = get_field('show_promo');
$show_free_shipping = get_field('show_free_shipping');
$show_producer_logo = get_field('show_producer_logo');
$product_links = get_field('product_links', 'option');
$promo_products = get_field('promo_product-week', 'option');

global $product;
@endphp

@extends('layouts.app')
@section('content')

@php
if ( ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_id() );
}
do_action( 'woocommerce_before_main_content' );

$categories = get_the_terms($product->get_id(), 'product_cat');
@endphp

@include('partials.page-header')
<div class="product product-single">
  <div class="container">
    @php
    do_action( 'woocommerce_before_single_product' );
    @endphp
    <div class="grid grid-cols-12 gap-4 mx-auto">
      <div class="col-span-12 lg:col-span-3 lg:mb-10">
        <button id="btn_category_filter" class="btn-primary w-full block lg:hidden mb-5">@php _e('Pokaz filtry', 'atcolor'); @endphp </button>
        <div id="category_filter" class="hidden lg:block category__filter mb-5 lg:mb-0">
          @include('sections.sidebar')
        </div>
        @include('.woocommerce.partials.sale-of-the-week')
      </div>
      <div class="col-span-12 lg:col-span-9">
        <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
          <!-- gallery product -->
            <div class="product__gallery col-span-1">
              @include('.woocommerce.components.product-gallery')

            </div>
            <!-- product summary --> 
            <div class="product__summary col-span-1">
              {{-- @php echo do_shortcode('[sale_countdown]') @endphp --}}
              <div class="product__content">
                <div class="text-7xl font-bold lg:mb-10 mb-5">
                  <h1>@php echo $product->get_name(); @endphp</h1>
                </div>
                <div class="product__meta flex flex-col">
                  <span class="stockis tablecustom">
                    <span>{!! __('Dostępność:') !!}</span>
                    @if($product->is_in_stock())
                        <span class="stock-status in-stock">{{ __('Produkt dostępny', 'woocommerce') }}</span>
                    @else
                        <span class="stock-status out-of-stock">{{ __('Produkt niedostępny', 'woocommerce') }}</span>
                    @endif
                  </span>
    
                  @if ($product->get_sku())
                  <span class="sku tablecustom">{!! __('<span>Kod:</span>', 'woocommerce') . ' ' . '<span class="text-black">'. $product->get_sku() .'</span>' !!}</span>
                  @endif
    
                  @if ($categories && !is_wp_error($categories))
    
                    @php
                      $main_category = '';
                    @endphp
    
                      @foreach ($categories as $category)
                          @if ($category->parent == 0)
                              @php
                                $main_category = $category->name;
                                $main_category_link = get_term_link($category->term_id);
                                break;
                              @endphp
                          @endif
                      @endforeach
    
                      @if (!empty($main_category)) 
                          <span class="category tablecustom">{!! __('<span>Kategoria:</span>', 'woocommerce') . '<span><a class="text-black" href="'.$main_category_link.'">'. $main_category .'</a></span>' !!}</span>
                      @endif
                  
                  @endif
                </div>
                <div class="product__short-description">
                  <?php the_excerpt(); ?>
                </div>
                <div class="product__price">
                  @if (get_field('fake_price', $product->get_id()))
                  <div class="fake-price">
                    @php $fake_price = get_field('fake_price', $product->get_id()); @endphp
                  </div>
                  @endif
                  {!! __( '<span>Cena:</span><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>'. $fake_price .'&nbsp;<span class="woocommerce-Price-currencySymbol">zł</span></bdi></span></del>', 'woocommerce' ) . ' ' . $product->get_price_html(); !!}
                </div>
                @php 
                do_action( 'woocommerce_single_product_summary' );
                @endphp
               
              </div>
              @if (!empty($product_links))
              <div class="product__bottom-info flex items-center">
                <div class="shipping-info space-x-4">
                  @foreach ($product_links as $product_link)
                  @php  
                    $link = $product_link['product_link'];
                  @endphp
                  <p class="inline-block text-sm"><a href="{{$link['url']}}">{!! $link['title'] !!}</a></p>
                  @endforeach
                </div>
              </div>
              @endif
            </div>
          </div>
          @php do_action( 'woocommerce_after_single_product_summary' ); @endphp

      </div>
    </div>
    
  </div>
  @php if (function_exists('woocommerce_output_related_products')) {
    woocommerce_output_related_products();
} @endphp
</div>

@include('partials.newsletter')
@endsection