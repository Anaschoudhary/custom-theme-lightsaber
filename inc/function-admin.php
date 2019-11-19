<?php

/**
 * @package LightSaberTheme
 * ADMIN PAGE
 * 
 */

 function lightsaber_add_admin_page(){

    add_menu_page('LightSaber Theme Options', 'LightSaber', 'manage_options', 'light-saber', 'lightsaber_theme_create_page',
     get_template_directory_uri(). '/img/lightsaber-icon.png', 110);
 }
 add_action('admin_menu', 'lightsaber_add_admin_page');

 function lightsaber_theme_create_page(){
     //generation of our admin page
     
 }