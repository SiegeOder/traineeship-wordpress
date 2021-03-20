<?php

function covid_register_styles()
{
    wp_enqueue_style( 'covid-style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css');
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap');
}

add_action('wp_enqueue_scripts', 'covid_register_styles');

function covid_register_scripts()
{
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script('modals', get_template_directory_uri().'/assets/js/ajax.js');
}

add_action('wp_footer', 'covid_register_scripts');