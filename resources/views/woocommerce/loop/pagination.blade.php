<?php
   /**
    * Pagination - Show numbered pagination for catalog pages
    *
    * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
    *
    * HOWEVER, on occasion WooCommerce will need to update template files and you
    * (the theme developer) will need to copy the new files to your theme to
    * maintain compatibility. We try to do this as little as possible, but it does
    * happen. When this occurs the version of the template file will be bumped and
    * the readme will list any important changes.
    *
    * @see     https://docs.woocommerce.com/document/template-structure/
    * @package WooCommerce\Templates
    * @version 3.3.1
    */
   
   if ( ! defined( 'ABSPATH' ) ) {
   	exit;
   }
   
   $total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
   $current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
   $base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
   $format  = isset( $format ) ? $format : '';
   
   if ( $total <= 1 ) {
   	return;
   }
   ?>
<nav class="woocommerce-pagination">
   <?php
      echo paginate_links(
      	apply_filters(
      		'woocommerce_pagination_args',
      		array( // WPCS: XSS ok.
      			'base'      => $base,
      			'format'    => $format,
      			'add_args'  => false,
      			'current'   => max( 1, $current ),
      			'total'     => $total,
      			'prev_text' => is_rtl() ? '<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="59.5" y="59.5" width="59" height="59" rx="29.5" transform="rotate(-180 59.5 59.5)" fill="#F4F4F4" stroke="#B13126"/>
                <path d="M36.4646 41.4717C36.8074 41.1334 37 40.6745 37 40.1961C37 39.7176 36.8074 39.2588 36.4646 38.9204L27.4136 29.9891L36.4646 21.0578C36.7977 20.7175 36.982 20.2617 36.9779 19.7886C36.9737 19.3155 36.7814 18.863 36.4424 18.5285C36.1034 18.1939 35.6447 18.0042 35.1653 18.0001C34.6859 17.996 34.224 18.1778 33.8792 18.5065L23.5354 28.7135C23.1926 29.0518 23 29.5107 23 29.9891C23 30.4675 23.1926 30.9264 23.5354 31.2648L33.8792 41.4717C34.222 41.81 34.687 42 35.1719 42C35.6567 42 36.1217 41.81 36.4646 41.4717Z" fill="#2B2B2A"/>
                </svg>' : '<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="59.5" y="59.5" width="59" height="59" rx="29.5" transform="rotate(-180 59.5 59.5)" fill="#F4F4F4" stroke="#B13126"/>
                <path d="M36.4646 41.4717C36.8074 41.1334 37 40.6745 37 40.1961C37 39.7176 36.8074 39.2588 36.4646 38.9204L27.4136 29.9891L36.4646 21.0578C36.7977 20.7175 36.982 20.2617 36.9779 19.7886C36.9737 19.3155 36.7814 18.863 36.4424 18.5285C36.1034 18.1939 35.6447 18.0042 35.1653 18.0001C34.6859 17.996 34.224 18.1778 33.8792 18.5065L23.5354 28.7135C23.1926 29.0518 23 29.5107 23 29.9891C23 30.4675 23.1926 30.9264 23.5354 31.2648L33.8792 41.4717C34.222 41.81 34.687 42 35.1719 42C35.6567 42 36.1217 41.81 36.4646 41.4717Z" fill="#2B2B2A"/>
                </svg>',
      			'next_text' => is_rtl() ? '<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="#F4F4F4" stroke="#B13126"/>
                <path d="M23.5354 18.5283C23.1926 18.8666 23 19.3255 23 19.8039C23 20.2824 23.1926 20.7412 23.5354 21.0796L32.5864 30.0109L23.5354 38.9422C23.2023 39.2825 23.018 39.7383 23.0221 40.2114C23.0263 40.6845 23.2186 41.137 23.5576 41.4715C23.8966 41.8061 24.3553 41.9958 24.8347 41.9999C25.3141 42.004 25.776 41.8222 26.1208 41.4935L36.4646 31.2865C36.8074 30.9482 37 30.4893 37 30.0109C37 29.5325 36.8074 29.0736 36.4646 28.7352L26.1208 18.5283C25.778 18.19 25.313 18 24.8281 18C24.3433 18 23.8783 18.19 23.5354 18.5283Z" fill="#2B2B2A"/>
                </svg>' : '<svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="#F4F4F4" stroke="#B13126"/>
                <path d="M23.5354 18.5283C23.1926 18.8666 23 19.3255 23 19.8039C23 20.2824 23.1926 20.7412 23.5354 21.0796L32.5864 30.0109L23.5354 38.9422C23.2023 39.2825 23.018 39.7383 23.0221 40.2114C23.0263 40.6845 23.2186 41.137 23.5576 41.4715C23.8966 41.8061 24.3553 41.9958 24.8347 41.9999C25.3141 42.004 25.776 41.8222 26.1208 41.4935L36.4646 31.2865C36.8074 30.9482 37 30.4893 37 30.0109C37 29.5325 36.8074 29.0736 36.4646 28.7352L26.1208 18.5283C25.778 18.19 25.313 18 24.8281 18C24.3433 18 23.8783 18.19 23.5354 18.5283Z" fill="#2B2B2A"/>
                </svg>',
                'type' => 'list',
                    'end_size' => 1, // Number of page numbers at the ends
                    'mid_size' => 1, // Number of page numbers on either side of the current page
                )
      	)
      );
      ?>
</nav>