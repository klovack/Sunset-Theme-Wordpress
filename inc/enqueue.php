<?php

/*
@package sunsettheme

    ===============================
        ADMIN ENQUEUE FUNCTIONS
    ===============================
*/

function sunset_load_admin_scripts($hook) {
    if ($hook == 'toplevel_page_rizki_sunset') {
        wp_register_style('sunset_admin_style', get_template_directory_uri() . '/css/sunset.admin.css', array(), '1.0.0');
        wp_enqueue_style('sunset_admin_style');
    
        wp_enqueue_media();
    
        wp_register_script('sunset_admin_script', get_template_directory_uri() . '/js/sunset.admin.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('sunset_admin_script');
    } elseif ($hook == 'sunset_page_rizki_sunset_css') {
        wp_enqueue_style('sunset-ace', get_template_directory_uri() . '/css/sunset.ace.css', array(), '1.0.0');
        wp_enqueue_script('ace', get_template_directory_uri() . '/js/ace/ace.js', array(), '1.4.12', true);
        wp_enqueue_script('ace_mode_css', get_template_directory_uri() . '/js/ace/mode-css.js', array(), '1.4.12', true);
        wp_enqueue_script('sunset-custom-css-script', get_template_directory_uri() . '/js/sunset.custom-css.js', array('jquery'), '1.0.0', true);
    }

}
add_action('admin_enqueue_scripts', 'sunset_load_admin_scripts');


/* 
    ==================================
        FRONTEND ENQUEUE FUNCTIONS
    ==================================

*/

function sunset_load_scripts() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.5.2', 'all' );
    wp_enqueue_style('raleway', 'https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700;900&display=swap');
    wp_enqueue_style('sunset', get_template_directory_uri() . '/css/sunset.css', array(), '1.0.0', 'all');
    wp_enqueue_style('sunset-blocks', get_template_directory_uri() . '/css/blocks.css', array(), '1.0.0', 'all');

    wp_deregister_script('jquery');

    // Jquery
    // Uncomment for production
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', array(), '3.5.1', true);
    // Comment for production
    wp_enqueue_script('jquery', get_template_directory_uri() . 'js/jquery-3.5.1.js', array(), '3.5.1', true);
    
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.js', array(), '4.5.2', true);
    wp_enqueue_script('sunset', get_template_directory_uri() . '/js/sunset.js', array(), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );