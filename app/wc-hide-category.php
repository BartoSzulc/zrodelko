<?php 
function hide_woocommerce_category_from_shop( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_post_type_archive('product') ) {
        $category_slug = 'zestawy-upominkowe';
        $category = get_term_by( 'slug', $category_slug, 'product_cat' );
        
        if ( $category ) {
            $query->set( 'tax_query', array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => array( $category->term_id ),
                    'operator' => 'NOT IN',
                ),
            ) );
        }
    }
}
add_action( 'pre_get_posts', 'hide_woocommerce_category_from_shop' );
