<?php

function custom_theme_styles_marka_cadey()
{
    // Register and enqueue stylesheet
    wp_enqueue_style('font-awsome-style', get_stylesheet_directory_uri() . '/css/all.css', array(), '', 'all');
    wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '', 'all');
    wp_enqueue_style('customs-style', get_stylesheet_directory_uri() . '/css/style.css', array('bootstrap-style'), '', 'all');

    // Register and enqueue JavaScript file
    wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', array(), '', true);
    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true);
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
}

// Hook into the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'custom_theme_styles_marka_cadey');
