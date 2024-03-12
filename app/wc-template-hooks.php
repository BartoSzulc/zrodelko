<?php

namespace App;



/*
 *
 * Change position default breadcrumb
 *
*/
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
add_action('woocommerce_custom_breadcrumbs', 'woocommerce_breadcrumb');
add_action('woocommerce_custom_breadcrumbs', __NAMESPACE__ . '\\custom_breadcrumb');

/**
 * Change several of the breadcrumb defaults
 */
function custom_breadcrumb() {
  $crumbs = array();

  // Add Home link
  $crumbs[] = array('Źródełko Chojnice', home_url());

  // Check if we are on a product page and get the product category
  if (is_product()) {
      global $post;
      $product_id = $post->ID;
      $product_name = get_the_title($product_id);
      $terms = get_the_terms($product_id, 'product_cat');

      if (!empty($terms)) {
          // Get the deepest level term
          $deepest_term = null;
          foreach ($terms as $term) {
              if (!isset($deepest_term->parent) || ($term->parent > 0 && (!isset($deepest_term->parent) || $term->parent > $deepest_term->parent))) {
                  $deepest_term = $term;
              }
          }

          if (isset($deepest_term)) {
              // Get parent categories
              $parent_terms = array();
              $parent_term_id = $deepest_term->parent;
              while ($parent_term_id) {
                  $parent_term = get_term($parent_term_id, 'product_cat');
                  $parent_terms[] = $parent_term;
                  $parent_term_id = $parent_term->parent;
              }

              // Add parent categories to breadcrumbs
              foreach ($parent_terms as $parent_term) {
                  $crumbs[] = array($parent_term->name, get_term_link($parent_term));
              }

              $crumbs[] = array($deepest_term->name, get_term_link($deepest_term));
          }
      }

      $crumbs[] = array($product_name, get_permalink($product_id));
  } elseif (is_product_category()) {
      // Add Product Category and Subcategories (if applicable)
      $term = get_queried_object();
      $parent_terms = get_ancestors($term->term_id, 'product_cat');
      $parent_terms = array_reverse($parent_terms);
      if (!empty($parent_terms)) {
          foreach ($parent_terms as $parent_id) {
              $parent_term = get_term($parent_id, 'product_cat');
              $crumbs[] = array($parent_term->name, get_term_link($parent_term));
          }
      }
      $crumbs[] = array($term->name, get_term_link($term));
  } else {
    if (is_page()) {
      global $post;
      $page_id = $post->ID;
      $ancestors = get_post_ancestors($page_id);

      // Add parent pages to breadcrumbs
      foreach ($ancestors as $ancestor_id) {
          $ancestor_title = get_the_title($ancestor_id);
          $crumbs[] = array($ancestor_title, get_permalink($ancestor_id));
      }

      // Add current page to breadcrumbs
      $page_title = get_the_title($page_id);
      $crumbs[] = array($page_title, get_permalink($page_id));
    }
    if (is_single()) {
      global $post;
      $page_id = $post->ID;
      $ancestors = get_post_ancestors($page_id);

      // Add parent pages to breadcrumbs
      foreach ($ancestors as $ancestor_id) {
          $ancestor_title = get_the_title($ancestor_id);
          $crumbs[] = array($ancestor_title, get_permalink($ancestor_id));
      }

      // Add current page to breadcrumbs
      $page_title = get_the_title($page_id);
      $crumbs[] = array($page_title, get_permalink($page_id));
    }
  }

    // Output breadcrumb with link on last item
    if (!empty($crumbs)) {
      echo '<nav class="woocommerce-breadcrumb">';
      $total_crumbs = count($crumbs);
      foreach ($crumbs as $key => $crumb) {
          echo '<a href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a>';
          if ($key < $total_crumbs - 1) {
              echo ' <span class="text-black">/</span> ';
          }
      }
      echo '</nav>';
    }
    // // Output breadcrumb without link on last item
    // echo '<nav class="woocommerce-breadcrumb">';
    // foreach ($crumbs as $key => $crumb) {
    //     if (!empty($crumb[1]) && sizeof($crumbs) !== $key + 1) {
    //         echo '<a href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a>';
    //     } else {
    //         echo esc_html($crumb[0]);
    //     }
    //     if (sizeof($crumbs) !== $key + 1) {
    //         echo ' <span class="text-black">/</span> ';
    //     }
    // }
    // echo '</nav>';
}





/** 
 * Show netto price
 * */
// add_action('woocommerce_after_shop_loop_item_title', function () {
//     echo "<div class='formatted-price'>";
// },5);

// add_action('woocommerce_after_shop_loop_item_title', function () {
//     global $product;
//     if (wc_get_price_excluding_tax( $product )) {
//     $price_excl_tax = number_format( wc_get_price_excluding_tax( $product ), 2, ',', ' ' );
//     if ( $product->is_type('variable') ) {
//       echo "<div class='price-netto'>" .$price_excl_tax . " zł netto</div></div>";
//     } else {
//     echo "<div class='price-netto'>" .$price_excl_tax . " zł netto</div></div>";
//     }
//   }
// },15);


add_filter('woocommerce_available_variation', function ($data, $product, $variation) {

 
  $data['price_html'] = "<div class='price_netto-brutto'>";
  $data['price_html'] .=  "<div class='price-brutto'>Cena brutto  <span class='price-value'>" . woocommerce_price($variation->get_price_including_tax())  . "</span></div>";
  $data['price_html'] .=  "<div class='price-netto'>Cena netto <span class='price-value'>" . woocommerce_price($variation->get_price_excluding_tax()) . "</span></div>";
  $data['price_html'] .=  "</div>";
  return $data;
},10,3);


/** 
 * Automatically shortens WooCommerce product titles on the main shop, category, and tag pages
 * */
// add_filter('the_title', function ($title, $id) {
//     if ( ( is_shop() || is_front_page() || is_product_category() ) && get_post_type( $id ) === 'product' ) {
//         if ( strlen($title) > 44 ) { 
//           return substr($title, 0, 44) . '...';
//         } else {
//           return $title; 
//         }
//       } else {
//         return $title;
//       }
// },10, 2 );

/**
 *
 * Woocommerce ordering select change default name
 *
 */

add_filter('woocommerce_catalog_orderby', function ($options) {
  $options['price'] = 'Cena od najniższej';
  $options['price-desc'] = 'Cena od najwyższej';
  return $options;
});

function change_default_sorting_text( $default_sorting_options ) {
  // Modify the default sorting options
  $default_sorting_options['menu_order'] = '- sortuj wg -';

  return $default_sorting_options;
}
add_filter( 'woocommerce_catalog_orderby', __NAMESPACE__ . '\\change_default_sorting_text' );





// enable gutenberg for woocommerce
add_filter('use_block_editor_for_post_type', function ($can_edit, $post_type) {
  if($post_type == 'product'){
		$can_edit = true;
	}
	
	return $can_edit;
},10, 2);



add_shortcode('product-sku', function () {
  global $product;
?>

<div class="product_meta custom">

    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

    <?php esc_html_e( 'Kod produktu:', 'woocommerce' ); ?> <span
        class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
    <?php endif; ?>

</div>
<?php
},1);

/*
*
* Change attribute variations to attribute title
*
*/

add_filter('woocommerce_attribute_label', function ($label, $name, $product) {
  if( $name == 'pa_pojemnosc' && is_product() ) {
    $label = __('Wybór pojemności', 'woocommerce');
  }
  if( $name == 'pa_kolor' && is_product() ) {
    $label = __('Wybierz kolor', 'woocommerce');
  }
return $label;
}, 10, 3);


/**
 * Display attribute producent image on product
*/

add_shortcode('category_image_archive', function () {
 
  global $product;
 
  $terms = get_the_terms( $product->id, 'pa_producent' );
  
  if( !empty($terms) ) {
    
    $term = array_pop($terms);
    $logo = get_field('producer_logo', $term->taxonomy . '_' . $term->term_id );

    if ( ! empty( $logo ) ) {
      echo '<img class="producer-logo" src="' . $logo['url'] . '">';
    }
  }
});

/**
 * Free shipping
 */
add_shortcode('free_shipping_info', function () {
  $min_amount = 200;
  $current = WC()->cart->subtotal;
  if ($current < $min_amount) {
    if (is_cart() || is_checkout() || is_product()) {
      $added_text = '<span class="freeshipping__notice">Potrzebujesz <b>' . wc_price($min_amount - $current) . '</b> do darmowej wysyłki</span>';
    } else {
      $added_text = '<span class="freeshipping__notice">Potrzebujesz <b>' . wc_price($min_amount - $current) . '</b>do darmowej wysyłki</span>';
    }
    echo $added_text;
  }
});



/** 
 * 
 * Remove product data tabs 
 * 
 * */
// add_filter( 'woocommerce_product_tabs', function($tabs) {
//   unset( $tabs['additional_information'] ); 
//   return $tabs;
// },98 );

/** 
 * 
 * Add new product data tabs - zalecenia
 * 
 * */
// add_filter( 'woocommerce_product_tabs', function($tabs) {
//   $tabs[ 'description' ][ 'title' ] = 'Opis produktu';
  
//   if (get_field('product_zalecenia')) {
//   $tabs['desc_tab5'] = array( 
//     'title'     => __( 'Zalecenia', 'woocommerce' ),
//     'priority'  => 50,
//     'callback'  => function() {
//       echo get_field('product_zalecenia');
//     }
//   );  
//   }
//   if (get_field('product_details')) {
//     $tabs['desc_detail'] = array(
//       'title'     => __( 'Szczegóły', 'woocommerce' ),
//       'priority'  => 50,
//       'callback'  => function() {
//         echo get_field('product_details');
//       }
//   );  
//     }

//   return $tabs; 
// });


/**
 * Show only lowest prices in WooCommerce variable products
 */
add_filter('woocommerce_variable_sale_price_html', function ($price, $product) {
  // Sale Price
      $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
      sort( $prices );
      $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
      
      if ( $price !== $saleprice ) {
      $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
      }
      return $price;
},10, 2);
add_filter('woocommerce_variable_price_html', function ($price, $product) {
  if (is_front_page() ||  is_product() || is_checkout()) {
  // Main Price
  $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
  $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
  return $price;
  } else {
    return $price;
  }
},10, 2);



/**
 * 
 * Woocommerce my account nav
 * 
 */

add_filter( 'woocommerce_account_menu_items', function($menu_links) {
  unset( $menu_links['edit-address'] ); 
	unset( $menu_links['dashboard'] ); 
	unset( $menu_links['orders'] ); 
	unset( $menu_links['downloads'] ); 
	unset( $menu_links['edit-account'] ); 
	unset( $menu_links['customer-logout'] ); 

    $menu_links['dashboard'] = 'Kokpit';
	  $menu_links['edit-account'] = 'Dane konta';
    $menu_links['orders'] = 'Zamówienia';
    $menu_links['edit-address'] = 'Adresy';
    $menu_links['customer-logout'] = 'Wyloguj się';

	return $menu_links;
},20);

/**
 * 
 * Woocommerce danger product hidden shipping other than ups
 * 
 */
add_filter( 'woocommerce_package_rates', function($rates, $package) {
  $shipping_class_target = 46; 
  $in_cart = false;
  foreach ( WC()->cart->get_cart_contents() as $key => $values ) {
     if ( $values[ 'data' ]->get_shipping_class_id() == $shipping_class_target ) {
        $in_cart = true;
        break;
     } 
  }
  if ( $in_cart ) {
    // DPD 
    unset( $rates['flexible_shipping_single:1'] ); 
    // DPD Pobranie
    unset( $rates['flexible_shipping_single:3'] ); 
    // InPost Kurier
    unset( $rates['flexible_shipping_single:6'] ); 
    // InPost Kurier Pobranie
    unset( $rates['flexible_shipping_single:7'] ); 
    // Paczkomat
    unset( $rates['flexible_shipping_single:8'] ); 
    // Paczkomat
    unset( $rates['flexible_shipping_single:9'] ); 
  }
  return $rates;

}, 9999, 2);


// Show text label to 2 columns input in checkout 
add_filter( 'woocommerce_checkout_fields', function($fields) {
  $fields['billing']['billing_address_2'] = array(
    'label_class'  => '',
     );
  $fields['shipping']['shipping_address_2'] = array(
    'label_class'  => '',
    );
  return $fields;

});


/**
 *  Redirect Empty Cart/Checkout - WooCommerce
 */
add_action( 'woocommerce_before_checkout_form', function() {
  if ( is_wc_endpoint_url( 'order-received' ) ) return;

  echo do_shortcode('[woocommerce_cart]');
}, 20);


add_action( 'template_redirect', function() {
  if ( is_cart() && is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
      wp_safe_redirect( home_url() );
      exit;
   }
});


// /**
//  * Shipping limit cod online
//  */
// add_filter( 'woocommerce_available_payment_gateways', function($available_gateways) {
//   if ( ! is_admin() ) {

// 		$chosen_methods  = WC()->session->get( 'chosen_shipping_methods' );
// 		$chosen_shipping = $chosen_methods[0];
// 		// dpd pobranie
// 		if ( isset( $available_gateways['bacs'] ) && 0 === strpos( $chosen_shipping, 'flexible_shipping_single:3' ) ) {
//       unset( $available_gateways['przelewy24'] );
//       unset( $available_gateways['bacs'] );
// 		}
//     // ups pobranie
// 		if ( isset( $available_gateways['bacs'] ) && 0 === strpos( $chosen_shipping, 'flexible_shipping_single:11' ) ) {
//       unset( $available_gateways['przelewy24'] );
//       unset( $available_gateways['bacs'] );
// 		}
// 		// inpost pobranie
// 		if ( isset( $available_gateways['bacs'] ) && 0 === strpos( $chosen_shipping, 'flexible_shipping_single:7' ) ) {
//       unset( $available_gateways['przelewy24'] );
//       unset( $available_gateways['bacs'] );
// 		}
// 		// inpost paczkomat pobranie
// 		if ( isset( $available_gateways['bacs'] ) && 0 === strpos( $chosen_shipping, 'flexible_shipping_single:9' ) ) {
//       unset( $available_gateways['przelewy24'] );
//       unset( $available_gateways['bacs'] );
// 		}
// 	}

// 	return $available_gateways;
// });


add_filter( 'gettext', __NAMESPACE__ . '\\change_undo_text', 10, 3 );
function change_undo_text( $translated_text, $text, $domain ) {
    if ( $text === 'Undo?' && $domain === 'woocommerce' ) {
        $translated_text = __( '<span>Dodaj ponownie</span>', 'woocommerce' );
    }
    return $translated_text;
}

include 'wc-percentage-discount.php';
include 'wc-schedule-week-promo.php';
include 'wc-hide-category.php';
include 'wc-archive-page.php';
include 'wc-single-product.php';
// include 'wc-register-login-shortcode.php';

add_action('after_setup_theme', __NAMESPACE__ . '\\register_custom_image_sizes');
function register_custom_image_sizes() {
    add_image_size('full', 0, 0, false);
}

function my_aws_image_size( $image_size ) {
  return 'full';
}
add_filter( 'aws_image_size', __NAMESPACE__ . '\\my_aws_image_size' );


function add_hidden_class_to_categories() {
  $categories = get_terms(array(
      'taxonomy' => 'product_cat', // Assuming 'product_cat' is your product category taxonomy
      'hide_empty' => false,
  ));

  $js_output = '<script>';
  $js_output .= 'jQuery(document).ready(function($) {';

  foreach ($categories as $category) {
      $category_slug = 'bapf_term_' . $category->slug;
      $hide_category = get_field('hide_category_from_filter', $category);

      // Checking if the ACF field 'hide_category_from_filter' is true
      if ($hide_category) {
          $js_output .= '$(".bapf_attr_product_cat li.' . $category_slug . '").addClass("!hidden");';
      }
  }

  $js_output .= '});';
  $js_output .= '</script>';

  echo $js_output;
}
add_action('wp_footer',  __NAMESPACE__ . '\\add_hidden_class_to_categories');


add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-slider');