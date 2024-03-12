<?php
/* Replace text of Sale! badge with percentage */
add_filter('woocommerce_sale_flash', 'ds_replace_sale_text');

function ds_replace_sale_text($text)
{
    global $product;
    $stock = $product->get_stock_status();
    $product_type = $product->get_type();
    $sale_price = 0;
    $regular_price = 0;

    if ($product_type == 'variable') {
        $product_variations = $product->get_available_variations();
        $discount_percentages = array();

        foreach ($product_variations as $variation) {
            $variation_sale_price = $variation['display_price'];
            $variation_regular_price = $variation['display_regular_price'];

            if ($variation_sale_price < $variation_regular_price) {
                $variation_discount_percentage = (($variation_regular_price - $variation_sale_price) / $variation_regular_price) * 100;
                $discount_percentages[] = $variation_discount_percentage;
            }
        }

        if (!empty($discount_percentages) && $stock != 'outofstock') {
            $product_sale = max($discount_percentages);

            if ($product_sale > 5) {
                return '<span class="onsale"> -' . esc_html($product_sale) . '%</span>';
            } elseif ($product_sale <= 5) {
                return '<span class="onsale">Sale!</span>';
            }
        } else {
            return '';
        }
    } else {
        $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
        $sale_price = get_post_meta(get_the_ID(), '_sale_price', true);

        if ($regular_price > 5) {
            $product_sale = intval(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
            return '<span class="onsale">  -' . esc_html($product_sale) . '%</span>';
        } elseif ($regular_price >= 0 && $regular_price <= 5) {
            $product_sale = intval(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
            return '<span class="onsale">Sale!</span>';
        } else {
            return '';
        }
    }
}


add_action('woocommerce_before_shop_loop_item', 'display_fake_price_after_if_not_on_sale', 25);

function display_fake_price_after_if_not_on_sale() {
    global $product;
    if ( !$product->is_on_sale() ) {
        if(get_field('fake_price_after', $product->get_id())) {
            echo '<div class="onsale"> -' . get_field('fake_price_after', $product->get_id()) . '%</div>';
        }
       
    }
}



// add_filter('woocommerce_get_price_html', 'hide_regular_price', 10, 2);
// function hide_regular_price($price, $product) {
//     if ($product->is_on_sale()) {
//         $price = '<ins>' . wc_price($product->get_sale_price()) . '</ins>';
//     }
//     return $price;
// }



