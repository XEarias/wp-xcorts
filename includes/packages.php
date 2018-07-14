<?php 

function adding_packages() {

    wp_enqueue_script("jquery");
    //Bootstrap 4.1.1
    wp_register_style('bootstrap', get_template_directory_uri() . '/packages/bootstrap/dist/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap');

    wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js');
    wp_enqueue_script('bootstrap');

    /*SLICK SLIDER*/
    wp_register_script('slick-js', get_template_directory_uri() . '/packages/slick-carousel/slick/slick.min.js');
    wp_enqueue_script('slick-js');
    wp_register_style('slick-css', get_template_directory_uri() . '/packages/slick-carousel/slick/slick.css');
    wp_enqueue_style('slick-css');
    wp_register_style('slick-theme.css', get_template_directory_uri() . '/packages/slick-carousel/slick/slick.css');
    wp_enqueue_style('slick-theme-css');

    /*CUSTOM*/
    wp_register_script('escort_item', get_template_directory_uri(). '/assets/js/escort_item.js');
    wp_enqueue_script('escort_item');

    wp_register_script('escort_slider', get_template_directory_uri(). '/assets/js/escort_slider.js');
    wp_enqueue_script('escort_slider');

    wp_enqueue_style( 'fmp-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'adding_packages' );

?>