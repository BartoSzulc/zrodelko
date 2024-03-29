<!-- Products content without sidebar category -->
<div class="category__products-content col-span-12 mb-10">
    @if(woocommerce_product_loop())
    @php
    do_action('woocommerce_before_shop_loop');
    woocommerce_product_loop_start();
    @endphp
    @if(wc_get_loop_prop('total'))
        @while(have_posts())
            @php
              the_post();
              do_action('woocommerce_shop_loop');
              wc_get_template_part('content', 'product');
            @endphp
          @endwhile
        @endif
        @php
          woocommerce_product_loop_end();
          do_action('woocommerce_after_shop_loop');
        @endphp
      @else
        @php
          do_action('woocommerce_no_products_found');
        @endphp
      @endif
</div>