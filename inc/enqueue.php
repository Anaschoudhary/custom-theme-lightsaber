<?php

/**
 * @package LightSaberTheme
 * 
 * =======================
 * ADMIN ENQUEUE FUNCTIONS
 * =======================
 */


function lightsaber_load_admin_scripts($hook){

    //echo $hook;
    if('toplevel_page_light_saber' != $hook){
        return;
    }

    wp_register_style('lightsaber_admin', get_stylesheet_directory_uri() . '/css/lightsaber.admin.css');
    wp_enqueue_style('lightsaber_admin');

    wp_enqueue_media();
    wp_register_script('lightsaber_admin_script', get_stylesheet_directory_uri() . '/js/lightsaber.admin.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('lightsaber_admin_script');

}

add_action('admin_enqueue_scripts', 'lightsaber_load_admin_scripts');
