<?php

namespace App\Setup\Environment;

require_once(ABSPATH . 'wp-admin/includes/user.php');

class Init
{
    public function __construct()
    {
        $this->unwantend_plugins = ['hello.php', 'akismet/akismet.php'];
    }

    public function init()
    {
        $this->deleteWpDefaultContent();
        $this->removeWpDefaultPlugins();
    }

    private function deleteWpDefaultContent()
    {
        wp_delete_post(1);
        wp_delete_post(2);
    }

    private function removeWpDefaultPlugins()
    {
        add_action('admin_init', function () {
            foreach ($this->unwantend_plugins as $plugin) {
                if (file_exists(WP_PLUGIN_DIR . '/' . $plugin)) {
                    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    delete_plugins(array($plugin));
                }
            }
        });
    }

}
