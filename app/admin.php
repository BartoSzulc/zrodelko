<?php

/**
 * Theme admin.
 */

namespace App;

add_action('admin_bar_menu', function () {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
        'id' => 'env-info',
        'parent' => 'top-secondary',
        'title' => '<p style="background-color:#ff8c00; padding: 0 10px;" class="env-info env-info--' . ENV . '">' . ENV . '</p> '
    ));
    if (ENV === 'development') {
        $wp_admin_bar->add_menu(array(
            'id' => 'gregor-media',
            'parent' => 'top-secondary',
            'title' => '<p><a style="display: flex; align-items:center;" href="https://gregormedia.com.pl/" target="_blank" rel="noopener">
            <img style="width: 100%; height: 20px;" class="lazy loaded" alt="logo gregormedia" id="logo" src="https://gregormedia.com.pl/wp-content/themes/gregormedia/resources/img/logo_gregormedia_white.svg" data-src="https://gregormedia.com.pl/wp-content/themes/gregormedia/resources/img/logo_gregormedia_white.svg" data-was-processed="true">
        </a></p>'
        ));
    }
});

function modify_admin_toolbar($admin_bar)
{
    $theme = wp_get_theme();

    $admin_bar->add_menu(array(
        'id' => get_template(),
        'title' => $theme->name,
        'href' => '#',
        'meta' => array(
            'title' => __($theme->name),
        ),
    ));
    $admin_bar->add_menu(array(
        'id' => 'settings-link',
        'parent' => get_template(),
        'title' => 'Zarządzanie motywem',
        'href' => admin_url('admin.php?page=zarzadzanie-motywem'),
        'meta' => array(
            'title' => __('Zarządzanie motywem'),
            'class' => 'settings-class bg-primary'
        ),
    ));
}
add_action('admin_bar_menu', __NAMESPACE__ . '\\modify_admin_toolbar', 100);

function wpb_remove_version()
{
    return '';
}
add_filter('the_generator', __NAMESPACE__ . '\\wpb_remove_version');

function remove_from_admin_bar($wp_admin_bar)
{
    $wp_admin_bar->remove_node('comments');
}
add_action('admin_bar_menu', __NAMESPACE__ . '\\remove_from_admin_bar', 999);

function change_footer_version()
{
    $theme = wp_get_theme();
    echo $theme->name . ' ' . $theme->version;
}
add_filter('update_footer', __NAMESPACE__ . '\\change_footer_version', 9999);

function no_wordpress_errors()
{
    return 'Nieprawidłowe dane logowania!';
}
add_filter('login_errors', __NAMESPACE__ . '\\no_wordpress_errors');

function remove_admin_menu_items_prod()
{
    remove_menu_page('edit.php?post_type=acf-field-group');
}

if (ENV === 'production' || ENV === 'init') {
    add_action('admin_menu', __NAMESPACE__ .  '\\remove_admin_menu_items_prod');
}

if (ENV === 'development' || ENV === 'init') {
    add_filter('show_admin_bar', '__return_false');
}