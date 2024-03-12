<?php

namespace App\Setup\Environment;

class Common
{
    public function __construct()
    {
        $this->required_plugins = array(
            'advanced-custom-fields-pro/acf.php'
        );
        $this->mode = ENV;
    }

    public function init()
    {
        $this->runRequiredPlugins();
        $this->addProjectNameClassToBody();
        $this->customAdminBar();
        $this->configComments();
    }

    private function configComments()
    {
        add_action('admin_init', function () {
            global $pagenow;
            if ($pagenow === 'edit-comments.php') {
                wp_redirect(admin_url());
                exit;
            }
            remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

            foreach (get_post_types() as $post_type) {
                if (post_type_supports($post_type, 'comments')) {
                    remove_post_type_support($post_type, 'comments');
                    remove_post_type_support($post_type, 'trackbacks');
                }
            }
        });

        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);

        add_filter('comments_array', '__return_empty_array', 10, 2);

        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
        });

        add_action('init', function () {
            if (is_admin_bar_showing()) {
                remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
            }
        });
    }

    private function addProjectNameClassToBody()
    {
        add_filter('body_class', function ($classes) {
            $classes[] = THEME_SLUG;
            return $classes;
        });
    }

    private function runRequiredPlugins()
    {
        foreach ($this->required_plugins as $plugin) {
            $this->activatePlugin($plugin);
        }
    }

    private function activatePlugin($plugin)
    {
        $current = get_option('active_plugins');
        $plugin = plugin_basename(trim($plugin));

        if (!in_array($plugin, $current)) {
            $current[] = $plugin;
            sort($current);
            do_action('activate_plugin', trim($plugin));
            update_option('active_plugins', $current);
            do_action('activate_' . trim($plugin));
            do_action('activated_plugin', trim($plugin));
        }
    }

    private function customAdminBar()
    {
        add_filter('body_class', function ($classes) {
            $class = $this->mode;
            $classes[] = $class;
            return $classes;
        });
    }
}
