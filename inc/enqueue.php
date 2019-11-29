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
    if('toplevel_page_light_saber' == $hook){  

        wp_register_style('lightsaber_admin', get_stylesheet_directory_uri() . '/css/lightsaber.admin.css');
        wp_enqueue_style('lightsaber_admin');

        wp_enqueue_media();
        wp_register_script('lightsaber_admin_script', get_stylesheet_directory_uri() . '/js/lightsaber.admin.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('lightsaber_admin_script');

    }elseif('lightsaber_page_light_saber_css' == $hook){

        wp_enqueue_style('ace', get_stylesheet_directory_uri().'/css/lightsaber.ace.css');
        wp_enqueue_script('ace', get_stylesheet_directory_uri().'/js/ace/ace.js', array('jquery'), '1.2.1', true);
        wp_enqueue_script('ls-custom-css-script', get_stylesheet_directory_uri().'/js/lightsaber.custom_css.js', array('jquery'), '1.2.1', true);


    } else{ return; }
   

}

add_action('admin_enqueue_scripts', 'lightsaber_load_admin_scripts');

/**
 * =======================
 * FRONTEND ENQUEUE FUNCTIONS
 * =======================
 */

 function ls_load_scripts(){

    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style('lightsaber', get_stylesheet_directory_uri().'/css/ls.css');

    wp_deregister_script('jquery');
    wp_register_script('jquery', get_stylesheet_directory_uri().'/js/jquery.js', false, '3.4.1', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.4.1', true);
    
 }

 add_action('wp_enqueue_scripts', 'ls_load_scripts');