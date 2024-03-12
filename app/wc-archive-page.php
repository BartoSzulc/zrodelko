<?php 
function custom_woocommerce_result_count() {
    $total = 0;
  
    if (function_exists('wc_get_loop_prop')) {
        $total = wc_get_loop_prop('total');
    } elseif (function_exists('wc_get_loop_prop')) {
        global $woocommerce;
        $total = $woocommerce->query->found_posts;
    }
  
    if (!$total) {
        return '';
    }
  
    $per_page = get_query_var('posts_per_page');
    $current = (get_query_var('paged')) ? get_query_var('paged') : 1;
  
    $result = sprintf('%d %s', $total, ($total == 1 ? 'produkt' : ($total >= 2 && $total <= 4 ? 'produkty' : 'produktów')));
  
    return $result;
  }
  
  
  function custom_category_title_result_count() {
    $category_title = single_term_title( '', false );
    $result_count   = custom_woocommerce_result_count(); // Use your custom result count function
    $category_id = get_queried_object_id(); // Get the current category ID
    $category_title_acf = get_field('category_title', 'category_' . $category_id); // Use the category ID to fetch the ACF field
    if (is_product_category()) {
      echo '<div class="category-info">';
      
      // Get the category title (using ACF field if available, otherwise using default category title)
      $category_id = get_queried_object_id(); // Get the current category ID
      $category_title_acf = get_field('category_title', 'category_' . $category_id); // Use the category ID to fetch the ACF field
  
      if (!empty($category_title_acf)) {
          echo '<h1 class="category-title">' . $category_title_acf . '</h1>';
      } else {
          $category = get_queried_object();
          $category_title_default = $category->name;
          echo '<h1 class="category-title">' . $category_title_default . '</h1>';
      }
  
      // Display the result count
      echo '<p class="result-count">' . $result_count . '</p>';
      echo '</div>';
  
      // Get the category description
      $category = get_queried_object();
      $category_description = $category->description;
      if (!empty($category_description)) {
          echo '<div class="category-description">' . wpautop($category_description) . '</div>';
      }
    }
    elseif ( is_shop() ) {
      $shop_page = get_post( wc_get_page_id( 'shop' ) );
      echo '<div class="regular-info category-info">';
      echo '<h2 class="page-title">' . $shop_page->post_title . '</h2>';
      echo '<p class="result-count">' . $result_count . '</p>';
      echo '</div>';
    } else {
      echo '<div class="regular-info category-info">';
      echo '<h2 class="page-title">' . get_the_title() . '</h2>';
      echo '<p class="result-count">' . $result_count . '</p>';
      echo '</div>';
    }
   
    echo '<div class="pagination-container">';
          woocommerce_catalog_ordering();
          woocommerce_pagination();
    echo '</div>';
  }
  add_action( 'woocommerce_before_shop_loop', __NAMESPACE__ . '\\custom_category_title_result_count', 10 );
  
  // remove default result count
  if (is_product_category()) {
    
  }
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_filter( 'paginate_links', function($link) {
    if(is_paged()){$link= str_replace('page/1/', '', $link);}
    return $link;
} );

/**
 * Hide shipping rates when free shipping is available, but keep "Local pickup" 
 * Updated to support WooCommerce 2.6 Shipping Zones
 */

 function hide_shipping_when_free_is_available( $rates, $package ) {
	$new_rates = array();
	foreach ( $rates as $rate_id => $rate ) {
		// Only modify rates if free_shipping is present.
		if ( 'free_shipping' === $rate->method_id ) {
			$new_rates[ $rate_id ] = $rate;
			break;
		}
	}

	if ( ! empty( $new_rates ) ) {
		//Save local pickup if it's present.
		foreach ( $rates as $rate_id => $rate ) {
			if ('local_pickup' === $rate->method_id ) {
				$new_rates[ $rate_id ] = $rate;
				break;
			}
		}
		return $new_rates;
	}

	return $rates;
}

add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2 );


// Add ACF fields to WooCommerce product loop
function custom_add_acf_fields_to_product_loop() {
  global $product;
  $custom_field_value = get_field('truefalse_checkbox_select');
  $select_field = get_field('checkbox_select');
  // Check if the ACF field has a value
  if ($custom_field_value) {
      echo '<div class="custom-acf-field">' . esc_html($select_field) . '</div>';
  }
}

add_action('woocommerce_before_shop_loop_item', 'custom_add_acf_fields_to_product_loop', 10);
