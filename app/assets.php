<?php

namespace App;

function _defer_css($html, $handle){
    $deferred_stylesheets = apply_filters('deferred_stylesheets', array());
    if (in_array($handle, $deferred_stylesheets, true)) {
        return str_replace('rel=\'stylesheet\'', 'media="all" rel="preload" type="text/css"  as="style"  onload = "this.onload = null; this.rel = \'stylesheet\';"', $html);
    } else {
        return $html;
    }
}


add_filter('style_loader_tag', __NAMESPACE__ . '\\_defer_css', 10, 2);

add_filter('deferred_stylesheets', function ($handles) {
    $handles[] = 'contact-form-7';
    $handles[] = 'wp-block-library';
    return $handles;
}, 10, 1);
