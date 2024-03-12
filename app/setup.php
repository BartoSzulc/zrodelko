<?php

/**
 * Theme setup.
 */

namespace App;

// Wp Query class
use WP_Query;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue()->localize('example', [
        'ajax_url' => admin_url('admin-ajax.php'),

    ]);
    // Woo script
    if (is_shop() || is_product_category() || is_product() || is_checkout()) {
        bundle('woocommerce')->enqueue();
    }
    
   

}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage'),
        'footer_navigation2' => __('Footer Navigation 2', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);
    add_image_size('1by1', 64, 64, true);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

add_action('init', function() {
    register_block_style('core/paragraph', [
        'name' => 'reset-space',
        'label' => __('Wyłącz domyślne marginesy', THEME_SLUG),
    ]);

    register_block_style('core/heading', [
        'name' => 'reset-space',
        'label' => __('Wyłącz domyślne marginesy', THEME_SLUG),
    ]);
});

// /**
//  * Register CPT
//  *
//  * @return void
//  */

// add_action('init', function () {
//     require('Plugins/CPT.php');
// });

// Off Gutenberg editor for subpages
add_filter('use_block_editor_for_post', function ($use_block_editor, $post) {
    if ($post->post_type === 'page') {
        return false;
    }
    return $use_block_editor;
}, 10, 2);

function weichie_load_more()
{
    $ajaxposts = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $_POST['paged'],
    ]);

    if (isset($_GET['cat'])) {
        $cat_s = $_GET['cat'];
        if ($cat_s != '') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $cat_s,
                ],
            ];
        }
    }
    
    if (isset($_GET['title'])) {
        $title_s = $_GET['title'];
        if ($title_s != '') {
            $args['s'] = $title_s;
        }
    }

    $response = '';

    if ($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            // Get Template part with sage 10
            $response .= view('partials.content-blog', ['new' => get_post()])->render();
        endwhile;

    } else {
        $response = '';
    }

    echo $response;
    exit;
}
add_action('wp_ajax_weichie_load_more', __NAMESPACE__ . '\\weichie_load_more');
add_action('wp_ajax_nopriv_weichie_load_more', __NAMESPACE__ . '\\weichie_load_more');

// Disable Gutenberg on the back end.
add_filter( 'use_block_editor_for_post', '__return_false' );

// Disable Gutenberg for widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

add_action( 'wp_enqueue_scripts', function() {
    // Remove CSS on the front end.
    wp_dequeue_style( 'wp-block-library' );

    // Remove Gutenberg theme.
    wp_dequeue_style( 'wp-block-library-theme' );

    // Remove inline global CSS on the front end.
    wp_dequeue_style( 'global-styles' );
}, 20 );
add_action('template_redirect', function () {
    if ( is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
        wp_safe_redirect( get_permalink( wc_get_page_id( 'shop' ) ) ); 
            exit;
        }
});

add_filter('woocommerce_get_cart_url', function () {
    return wc_get_checkout_url();
}, 10, 1);


