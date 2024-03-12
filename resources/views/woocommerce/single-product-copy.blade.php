@php
$subtitle = get_field('subtitle');
$extra_cost = get_field('extra-cost');
$images = get_field('product_gallery');
$product_shipping_time = get_field('product_shipping_time');
$product_document = get_field('product_document');
$show_promo = get_field('show_promo');
$show_free_shipping = get_field('show_free_shipping');
$show_producer_logo = get_field('show_producer_logo');

global $product;
@endphp

@extends('layouts.app')
@section('content')

@php
if ( ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_id() );
}
do_action( 'woocommerce_before_main_content' );
@endphp

@include('partials.page-header')
<div class="product">
  <div class="container">
    @php
    do_action( 'woocommerce_before_single_product' );
    @endphp
    <div class="grid grid-cols-12">
      <!-- gallery product -->
        <div class="product__gallery col-span-12 xl:col-span-6 relative">
          {{-- @include('.woocommerce.components.product-gallery') --}}
          @php
            if (has_post_thumbnail($product->get_id())) {
              $image_id = get_post_thumbnail_id($product->get_id());
              $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
              $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
              
              echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
            }
          @endphp
          
        </div>
        <!-- product summary --> 
        <div class="product__summary  col-span-12 xl:col-span-6">
          @php echo do_shortcode('[sale_countdown]') @endphp
          <div class="product__content">
            @php echo do_shortcode('[product-sku]') @endphp
      
            <h3 class="text-text-400  mt-3  mr-2 xs:mr-2  mb-2  text-xl xs:text-2xl xs:mt-8 xl:mt-6  xs:mb-6 xl:mb-2 xl:text-3xl">@php echo $product->get_name(); @endphp</h3>
            @php 
            do_action( 'woocommerce_single_product_summary' );
            @endphp
            <div class="product__bottom-info flex items-center">
              @if ($show_free_shipping)
              <div class="free-shipping">
                @svg('shipping-primary', 'inline-block mr-2') @php echo do_shortcode('[free_shipping_info]') @endphp
              </div>
              @endif
              @if ($product_shipping_time)
              <div class="time-shipping">
                <p class="inline-block text-sm">@php _e('Produkt dostarczymy w ciągu', 'atcolor'); @endphp <span class="font-bold"> {{$product_shipping_time}} </span></p>
              </div>
              @endif
            </div>
          </div>
        </div>
</div>
</div>

@include('partials.newsletter')
@endsection