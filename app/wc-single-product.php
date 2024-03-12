<?php 

function change_in_stock_text( $availability, $product ) {
    $availability['availability'] = 'Produkt dostępny';
    return $availability;
}
add_filter( 'woocommerce_get_availability', 'change_in_stock_text', 10, 2 );


/** 
 * Single product page accessories
 * */

add_action('woocommerce_before_main_content', function () {
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 60 );
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 12);

return;
},1, 0);


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product_summary', __NAMESPACE__ . '\\woo_display_product_description', 10 );
function woo_display_product_description() {
  global $post;
  if ( $post->post_content ) {
      echo '<div class="product-description">';
      echo '<div class="container">';
      echo '<h2 class="text-5xl font-bold mb-5 lg:mb-10 text-black">' . __( 'Opis produktu', 'woocommerce' ) . '</h2>';
      the_content();
      // Display ACF fields
      $additional_info = get_field( 'additional_information', $post->ID );
      $product_details = get_field( 'product_details', $post->ID );
      $two_columns = get_field( 'two_columns', $post->ID );
      $title = $additional_info['title'];
      $content = $additional_info['content'];
      if (!empty($title) || !empty($content)) {
        echo '<div class="product-description__additional-information">';
        if (!empty($title)) {
          
          echo '<div class="title">' . $title . '</div>';
        }
        if (!empty($content)) {
          echo '<div class="content">' . $content . '</div>';
        }
        echo '</div>';
      }
      if (!empty($product_details)) {
        echo '<div class="product-description__product-details">';
        foreach ($product_details as $product_detail) {
            $title = $product_detail['title'];
            $content = $product_detail['content'];
            if (!empty($title) && !empty($content)) {
                echo '<div class="product-description__product-details--item">';
                if (!empty($title)) {
                echo '<div class="title">' . $title . '</div>';
                }
                if (!empty($content)) {
                echo '<div class="content">' . $content . '</div>';
                }
                echo '</div>';
            }
        }
        echo '</div>';
      }
      if (!empty($two_columns)) {
        echo '<div class="product-description__two-columns">';
        $content = $two_columns['content'];
        $content_1 = $two_columns['content_1'];
        if (!empty($content) || !empty($content_1)) {
            
            if (!empty($content)) {
            echo '<div class="content">' . $content . '</div>';
            }
            if (!empty($content_1)) {
            echo '<div class="content">' . $content_1 . '</div>';
            }
           
        }
        echo '</div>';
      }
      echo '</div>
      </div>';
  }
}


