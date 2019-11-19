<?php

/**
 * @package LightSaberTheme
 * ADMIN PAGE
 * 
 */

 function lightsaber_add_admin_page(){

    //Generate admin page
    add_menu_page('LightSaber Theme Options', 'LightSaber', 'manage_options', 'light_saber', 'lightsaber_theme_create_page',
     get_template_directory_uri(). '/img/lightsaber-icon.png', 110);

    //Generate admin sub pages
    add_submenu_page('light_saber', 'LightSaber Theme Options', 'General', 'manage_options', 'light_saber', 
    'lightsaber_theme_create_page');

    add_submenu_page('light_saber', 'LightSaber CSS Options', 'Custom CSS', 'manage_options', 'light_saber_css', 
    'lightsaber_theme_settings_page');

    //Activate Custom Settings
    add_action('admin_init', 'lightsaber_custom_settings');
    
 }
 add_action('admin_menu', 'lightsaber_add_admin_page');

 function lightsaber_custom_settings(){
    register_setting('lightsaber-settings-group', 'first_name');
    add_settings_section('lightsaber-sidebar-options-id', 'Siderbar Options', 'lightsaber_sidebar_option_callback',
     'light_saber');
    add_settings_field('lightsaber-sidebar-field-id', 'First Name', 'lightsaber_sidebar_field_callback', 
    'light_saber', 'lightsaber-sidebar-options-id');
 }

 function lightsaber_sidebar_field_callback(){
     $firstName = esc_attr(get_option('first_name'));
     echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name">';
 }

 function lightsaber_sidebar_option_callback(){
     echo 'Edit Sidebar';
 }

 function lightsaber_theme_create_page(){
     require_once(get_template_directory(). '/inc/templates/lightsaber-admin.php');   
 }

 function lightsaber_theme_settings_page(){
     //generation of our admin sub page
 }