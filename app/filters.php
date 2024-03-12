<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});


/**
 * Custom class for wp menu <li> element
 *
 * @return array
 */
function add_additional_class_on_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', __NAMESPACE__ . '\\add_additional_class_on_li', 1, 3);

function add_menu_link_class( $atts, $item, $args ) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
  }
  add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\\add_menu_link_class', 1, 3 );
/**
 * Remove dashicons in frontend for unauthenticated users
 *
 * @return void
 */
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\bs_dequeue_dashicons');
function bs_dequeue_dashicons()
{
    if (!is_user_logged_in()) {
        wp_deregister_style('dashicons');
    }
}


/**
 * Disable emoji
 *
 * @return void
 */

function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // Remove from TinyMCE
    add_filter( 'tiny_mce_plugins', __NAMESPACE__ . '\\disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
add_action( 'init', __NAMESPACE__ . '\\disable_emojis' );

/**
 * Hide Wordpress Version Info
 *
 * @return string
 */
function remove_version_info()
{
    return '';
}
add_filter('the_generator', __NAMESPACE__ . '\\remove_version_info', 0);


/**
 * Add .active class to current-menu-item in menu
 *
 * @return array
 */
function special_nav_class ($classes, $item) {
    if (in_array('current-post-ancestor', $classes) || in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}
add_filter('nav_menu_css_class' , __NAMESPACE__ . '\\special_nav_class' , 10 , 2);



function prefix_remove_unnecessary_tags(){

    // REMOVE WP EMOJI
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );


    // remove all tags from header
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\prefix_remove_unnecessary_tags' );



function acf_set_featured_image( $value, $post_id, $field  ){
    if($value != ''){
        set_post_thumbnail( $post_id, $value);
    }
    return $value;
}

add_filter('acf/update_value/name=post_thumbnail', __NAMESPACE__ . '\\acf_set_featured_image', 10, 3);


add_filter( 'block_categories_all', function( $categories, $post ) {

    $all_categories = [];

    $theme_category = array(
            'slug'  => THEME_SLUG,
            'title' => THEME_SLUG,
    );

    $all_categories[0] = $theme_category;
    foreach ($categories as $category) {
        $all_categories[] = $category;
    }

    return $all_categories;
}, 10, 2 );

function add_class_to_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', __NAMESPACE__ . '\\add_class_to_li', 1, 3);

function add_class_to_a($atts, $item, $args) {
    if(isset($args->add_a_class)) {
        $atts['class'] = $args->add_a_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', __NAMESPACE__ . '\\add_class_to_a', 1, 3);



