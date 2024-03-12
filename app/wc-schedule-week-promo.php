<?php 

function display_sale_countdown() {
    global $product;
    $promo_products = get_field('promo_product-week', 'option'); // Get the relationship field value from options page

    // Check if the product is on sale, within the scheduled promotion period, and is present in the relationship field
    if ($product && $product->is_on_sale() && $product->is_purchasable() && $product->is_in_stock() && $promo_products && in_array($product->get_id(), $promo_products)) {
        $sale_start = $product->get_date_on_sale_from() ? $product->get_date_on_sale_from()->getTimestamp() : null;
        $sale_end = $product->get_date_on_sale_to() ? $product->get_date_on_sale_to()->getTimestamp() : null;
        $current_timestamp = current_time('timestamp');

        if ($sale_start && $sale_end && $sale_start <= $current_timestamp && $sale_end >= $current_timestamp) {
            // Calculate the remaining time until the sale end date
            $remaining_time = $sale_end - $current_timestamp;

            // Display the countdown if there is remaining time
            if ($remaining_time > 0) {
                $hours = floor($remaining_time / (60 * 60));
                $minutes = floor(($remaining_time % (60 * 60)) / 60);
                $seconds = $remaining_time % 60;

                ob_start();
                ?>
                <div class="sale-countdown">
                    <div id="countdown" class="flex items-center">
                        <span class="countdown-main hours-main">
                            <div class="title text-primary hours">
                                <span class="hours-count"><?php echo $hours; ?></span>
                            </div>
                            <div class="text-xs text-center">
                                <span>godzin</span>
                            </div>
                        </span>
                        <span class="divider">:</span>
                        <span class="countdown-main minutes-main">
                            <div class="title text-primary minutes">
                                <span class="minutes-count"><?php echo $minutes; ?></span>
                            </div>
                            <div class="text-xs">
                                <span>minut</span>
                            </div>
                        </span>
                        <span class="divider">:</span>
                        <span class="countdown-main seconds-main">
                            <div class="title text-primary seconds">
                                <span class="seconds-count"><?php echo $seconds; ?></span>
                            </div>
                            <div class="text-xs">
                                <span>sekund</span>
                            </div>
                        </span>
                    </div>
                </div>
                <script>
                    var countdownData = {
                        endDate: <?php echo $sale_end * 1000; ?>
                    };
                </script>
                <?php
                $output = ob_get_clean();

                return $output;
            }
        }
    }

    return '';
}
add_shortcode('sale_countdown', 'display_sale_countdown');

function display_sale_countdown_archive_shortcode($atts) {
    if (function_exists('wc_get_product')) {
        $promo_products = get_field('promo_product-week', 'option');
        
        ob_start();
        if ($promo_products) {
            foreach ($promo_products as $product_id) {
                $product = wc_get_product($product_id);
                
                if ($product && $product->is_on_sale()) {
                    $sale_start = $product->get_date_on_sale_from() ? $product->get_date_on_sale_from()->getTimestamp() : null;
                    $sale_end = $product->get_date_on_sale_to() ? $product->get_date_on_sale_to()->getTimestamp() : null;
                    $current_timestamp = current_time('timestamp');
    
                    if ($sale_start && $sale_end && $sale_start <= $current_timestamp && $sale_end >= $current_timestamp) {
                        $remaining_time = $sale_end - $current_timestamp;
                        
                        if ($remaining_time > 0) {
                            $hours = floor($remaining_time / (60 * 60));
                            $minutes = floor(($remaining_time % (60 * 60)) / 60);
                            $seconds = $remaining_time % 60;
                            ?>
                            <div class="sale-countdow mb-30">
                                <div id="countdown" class="flex items-center">
                                    <span class="countdown-main hours-main">
                                        <div class="title text-primary hours">
                                            <span class="hours-count"><?php echo $hours; ?></span>
                                        </div>
                                        <div class="text-xs text-center">
                                            <span>godzin</span>
                                        </div>
                                    </span>
                                    <span class="divider">:</span>
                                    <span class="countdown-main minutes-main">
                                        <div class="title text-primary minutes">
                                            <span class="minutes-count"><?php echo $minutes; ?></span>
                                        </div>
                                        <div class="text-xs">
                                            <span>minut</span>
                                        </div>
                                    </span>
                                    <span class="divider">:</span>
                                    <span class="countdown-main seconds-main">
                                        <div class="title text-primary seconds">
                                            <span class="seconds-count"><?php echo $seconds; ?></span>
                                        </div>
                                        <div class="text-xs">
                                            <span>sekund</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            
                            <script>
                                var countdownData = {
                                    endDate: <?php echo $sale_end * 1000; ?>
                                };
                            </script>
                            <?php
                        }
                    }
                }
            }
        } 
        $output = ob_get_clean();
        return $output;
    }

    return '';
}

// Register the shortcode for the WooCommerce archive page
add_shortcode('sale_countdown_archive', 'display_sale_countdown_archive_shortcode');



