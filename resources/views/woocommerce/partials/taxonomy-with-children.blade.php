    <!-- Category sidebar -->
    <div class="category__products-sidebar  col-span-12  mx-4 xs:col-span-12 xl:mx-0 xl:col-span-3 xl:pr-6">
        @php 
        // get the current product category term ID
        if ( is_product_category() ) {
            $term_id = (int) get_queried_object_id();
        }

        if ( term_exists( $term_id, 'product_cat' ) ) {
            $child_terms_ids = get_term_children( $term_id, 'product_cat' );
            echo '<div class="grid grid-cols-12">';
            // Loop through child terms Ids
            foreach ( $child_terms_ids as $child_term_id ) {
                $child_term = get_term_by( 'term_id', $child_term_id, 'product_cat' );
                // The term name
                $child_name = $child_term->name;
                // The term link
                $child_link = get_term_link( $child_term, 'product_cat' );
                // The term image
                $thumb_id = get_woocommerce_term_meta( $child_term->term_id, 'thumbnail_id', true );
                $term_img = wp_get_attachment_url(  $thumb_id );
                echo '<div class=" col-span-12  my-3 xs:col-span-6 xs:mr-6 md:col-span-4 md:mr-6 xl:mr-0 xl:col-span-12 xl:my-3 p-10 py-16 bg-grey-200">';
                echo '<img class="w-20 mb-2" src="' . $term_img. '" alt="' . $child_term->name . '" />';
                echo '<span class="text-lg text-text-400 py-4 pl-4">Seria</span>';
                echo '<h4 class=" text-text-400 pt-2 pb-2 pl-4">' . $child_name. '</h4>';
                echo '<a class="link ml-2 p-2 mb-1 inline-block link-dark-hover" href="'. $child_link .'" >Zobacz wszystkie'. get_svg('icon-arrow', 'fill-dark') .'</a>';
                echo '</div>';

            }
            echo '</div>';
        }

        @endphp
      </div>
      <!-- Products content -->
      <div class="category__products-content  col-span-12 xl:col-span-9 mb-7">
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