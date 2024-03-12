<?php

namespace App\Setup\Environment;

class Development
{
    public function init()
    {
        $this->noRobotsIndex();
        // $this->customResponsiveBar();
    }

    private function noRobotsIndex()
    {
        add_filter('wp_robots', 'wp_robots_no_robots');
    }

    private function customResponsiveBar()
    {
        add_filter('body_class', function ($classes) {
            $class = 'debug-screens';
            $classes[] = $class;
            return $classes;
        });
    }
}
