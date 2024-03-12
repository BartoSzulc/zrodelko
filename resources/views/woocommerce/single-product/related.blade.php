@php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp
@if ($related_products)
	<section class="related-products lg:py-60 bg-white lg:mt-60 mt-30 py-30">
		<div class="container">
			<div class="block lg:grid grid-cols-12 gap-4">

				@php
				$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Podobne produkty', 'woocommerce' ) );
				@endphp

				@if ( $heading )
				<div class="col-span-12">
					<div class="text-6xl font-bold text-center">
						<h2>@php wp_trim_words(_e('<span class="font-bold">Podobne</span> produkty', 'atcolor') , 10, '...' ); @endphp </h2>
					</div>
				</div>
				@endif
			
				<div class="col-span-1 lg:flex items-center justify-end relative z-10 hidden">
					@include('sections.home.partials.swiper-arrow', ['class' => "swiperRelated__nav--prev"])
				</div>

				<div class="swiperRelated lg:col-span-10 col-span-full relative overflow-hidden py-20">
					
					<div class="swiper-wrapper">
					@foreach ( $related_products as $related_product )
						<div class="swiper-slide">
						@php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' );
						@endphp
						</div>
					@endforeach
					</div>
					
				</div>
				<div class="w-full lg:hidden flex items-center justify-between lg:mt-60 mt-30 flex-col sm:flex-row space-y-30 sm:space-y-0">
					<div class="swiper-nav flex items-center space-x-4">
						@include('sections.home.partials.swiper-arrow', ['class' => "swiperRelated__nav--prev--mobile"])
						@include('sections.home.partials.swiper-arrow', ['class' => "swiperRelated__nav--next--mobile transform rotate-180"])
					</div>
					<div class="see-all__button">
					   <a href="{{ home_url('/nowosci/') }}" class="btn-secondary">{!! __('Zobacz wszystkie') !!}</a>
					</div>
				 </div>
				<div class="col-span-1 lg:flex items-center justify-start relative z-10 hidden">
					@include('sections.home.partials.swiper-arrow', ['class' => "swiperRelated__nav--next transform rotate-180"])
				</div>
								
			</div>
		</div>
	</section>
	<?php
endif;

wp_reset_postdata();
