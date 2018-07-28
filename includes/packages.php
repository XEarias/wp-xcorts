<?php 

function adding_packages() {

    wp_enqueue_script("jquery");

    //JQUERY EASING 4.1.1
    wp_register_script('jquery_easing', get_template_directory_uri() . '/packages/jquery.easing.min.js');
    wp_enqueue_script('jquery_easing');

    //JQUERY VALIDATION
    wp_register_script('jquery_validate', get_template_directory_uri() . '/packages/jquery-validate/jquery.validate.min.js');
    wp_enqueue_script('jquery_validate');

    wp_register_script('jquery_validate_methods', get_template_directory_uri() . '/packages/jquery-validate/additional-methods.min.js');
    wp_enqueue_script('jquery_validate_methods');

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

    wp_register_script('fancybox', get_template_directory_uri() . '/packages/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js');
    wp_enqueue_script('fancybox');

    wp_register_style('fancybox-css', get_template_directory_uri() . '/packages/fancybox/fancybox/jquery.fancybox-1.3.4.css');
    wp_enqueue_style('fancybox-css');

    /*CUSTOM*/
    wp_register_script('escort_item', get_template_directory_uri(). '/assets/js/escort_item.js');
    wp_enqueue_script('escort_item');

    wp_register_script('escort_slider', get_template_directory_uri(). '/assets/js/escort_slider.js');
    wp_enqueue_script('escort_slider');

    wp_register_script('escort_subscription', get_template_directory_uri(). '/assets/js/escort_subscription.js');
    wp_enqueue_script('escort_subscription');

    wp_register_script('escort_rangeinput', get_template_directory_uri(). '/assets/js/escort_sliderrangeinput.js');
    wp_enqueue_script('escort_rangeinput');

    wp_enqueue_style( 'fmp-style', get_stylesheet_uri() );


    wp_localize_script('escort_subscription', 'wp_params', [
        'home_url' => home_url()
        ]
    );

}

add_action( 'wp_enqueue_scripts', 'adding_packages' );


?>