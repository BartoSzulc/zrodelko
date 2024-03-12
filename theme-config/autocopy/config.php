<?php

//-- string: theme-slug
define('THEME_SLUG', 'tamago-flex');
//-- string: 'init' / 'production' / 'development' | Warning! 'init' deleted default content.
define('ENV', 'init');
define('COMMENTS', false);
define('ADMINBAR', false);

if (ENV === 'development' || ENV === 'init') {
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true);
} else {
    define('DISALLOW_FILE_EDIT', true);
    define('DISALLOW_FILE_MOD', true);
    define('WP_DEBUG', false);
    if (!WP_DEBUG) {
        ini_set('display_errors', 0);
    }
}

// CF 7 - remove <p> tag
define('WPCF7_AUTOP', false);

// SAGE VALUE.
$sage_env = (ENV === 'development' || ENV === 'init') ? 'development' : 'production';
define('WP_ENV', $sage_env);
