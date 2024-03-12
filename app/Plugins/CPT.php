<?php
register_extended_post_type('job-offers', [
    'show_in_feed' => true,
    'archive' => [
        'nopaging' => false,
    ],
    'menu_icon' => 'dashicons-businessman',
    'admin_cols' => array(
		// A taxonomy terms column:
		'cat' => array(
			'taxonomy' => 'job-cat'
		),
        'loc' => array(
			'taxonomy' => 'job-loc'
		),
        'time' => array(
			'taxonomy' => 'job-time'
		),
	),
], [
    'singular' => 'Oferta pracy',
    'plural'   => 'Oferty pracy',
    'slug'     => 'job-offers',
]);

register_extended_taxonomy('job-cat', 'job-offers', [

    # Use radio buttons in the meta box for this taxonomy on the post editing screen:
    'meta_box' => 'radio',

], [
    # Override the base names used for labels:
    'singular' => 'Kategoria',
    'plural'   => 'Kategoria',
    'slug'     => 'job-cat',
]);


register_extended_taxonomy('job-loc', 'job-offers', [

    # Use radio buttons in the meta box for this taxonomy on the post editing screen:
    'meta_box' => 'radio',

], [
    # Override the base names used for labels:
    'singular' => 'Lokalizacja',
    'plural'   => 'Lokalizacje',
    'slug'     => 'job-loc',
]);


register_extended_taxonomy('job-time', 'job-offers', [

    # Use radio buttons in the meta box for this taxonomy on the post editing screen:
    'meta_box' => 'radio',

], [
    # Override the base names used for labels:
    'singular' => 'Wymiar czasu pracy',
    'plural'   => 'Wymiar czasu pracy',
    'slug'     => 'job-time',
]);


