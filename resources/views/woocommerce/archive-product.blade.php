{{--
The Template for displaying product archives, including the main shop page which is a post type archive

This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see https://docs.woocommerce.com/document/template-structure/
@package WooCommerce/Templates
@version 3.4.0
--}}
@php 
$promo_products = get_field('promo_product-week', 'option');
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
        <div class="col-span-12 lg:col-span-3 lg:mb-10">
          <button id="btn_category_filter" class="btn-primary w-full block lg:hidden mb-5">@php _e('Pokaz filtry', 'atcolor'); @endphp </button>
          <div id="category_filter" class="hidden lg:block category__filter mb-5 lg:mb-0">
            @include('sections.sidebar')
          </div>
          @include('.woocommerce.partials.sale-of-the-week')
        </div>
        <div class="col-span-12 lg:col-span-9 product-listtest" id="product-list">
          @include('.woocommerce.partials.taxonomy-without-children')
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
