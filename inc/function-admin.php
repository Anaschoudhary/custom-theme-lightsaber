<?php

/**
 * @package LightSaberTheme
 * =======================
 * ADMIN PAGE FUNCTIONS
 * =======================
 * 
 */

 function lightsaber_add_admin_page(){

    //Generate admin page
    add_menu_page('LightSaber Theme Options', 'LightSaber', 'manage_options', 'light_saber', 'lightsaber_theme_create_page',
     get_template_directory_uri(). '/img/lightsaber-icon.png', 110);

    //Generate admin sub pages
    add_submenu_page('light_saber', 'LightSaber Sidebar Options', 'Sidebar', 'manage_options', 'light_saber', 
    'lightsaber_theme_create_page');

    add_submenu_page('light_saber', 'LightSaber Theme Options', 'Theme Options', 'manage_options', 'light_saber_theme_options', 
    'lightsaber_theme_options_page');

    add_submenu_page('light_saber', 'LightSaber CSS Options', 'Custom CSS', 'manage_options', 'light_saber_css', 
    'lightsaber_theme_settings_page');

    //Activate Custom Settings
    add_action('admin_init', 'lightsaber_custom_settings');
    
 }
 add_action('admin_menu', 'lightsaber_add_admin_page');

 function lightsaber_custom_settings(){
     //Sidebar options
    register_setting('lightsaber-settings-group', 'profile_picture');
    register_setting('lightsaber-settings-group', 'first_name');
    register_setting('lightsaber-settings-group', 'last_name');
    register_setting('lightsaber-settings-group', 'user_description');
    register_setting('lightsaber-settings-group', 'twitter_handler', 'lightsaber_sanitize_twitter');
    register_setting('lightsaber-settings-group', 'facebook_handler');
    register_setting('lightsaber-settings-group', 'github_handler');

    add_settings_section('lightsaber-sidebar-options-id', 'Siderbar Options', 'lightsaber_sidebar_option_callback','light_saber');
    
    add_settings_field('lightsaber-profile-picture-id', 'Profile Picture', 'lightsaber_profile_picture_callback', 'light_saber', 'lightsaber-sidebar-options-id');
    add_settings_field('lightsaber-sidebar-field-id', 'Full Name', 'lightsaber_sidebar_field_callback', 'light_saber', 'lightsaber-sidebar-options-id');
    add_settings_field('sidebar-description-id', 'Description', 'lightsaber_sidebar_description_callback', 'light_saber', 'lightsaber-sidebar-options-id');
    add_settings_field('sidebar-twitter-id', 'Twitter handler', 'lightsaber_sidebar_twitter_callback', 'light_saber', 'lightsaber-sidebar-options-id');
    add_settings_field('sidebar-facebook-id', 'Facebook handler', 'lightsaber_sidebar_facebook_callback', 'light_saber', 'lightsaber-sidebar-options-id');
    add_settings_field('sidebar-github-id', 'Github handler', 'lightsaber_sidebar_github_callback', 'light_saber', 'lightsaber-sidebar-options-id');

    //Theme Options 
    register_setting('ls-theme-option-group', 'post_formats');
    register_setting('ls-theme-option-group', 'custom_header');
    register_setting('ls-theme-option-group', 'custom_background');

    add_settings_section('ls-theme-option-section-id', 'Theme Options', 'ls_theme_options_section_callback', 'lightsaber_theme_options_page');

    add_settings_field('ls-post-formats-field-id', 'Post Formats', 'ls_post_formats_field_callback', 'lightsaber_theme_options_page', 'ls-theme-option-section-id');
    add_settings_field('ls-custom-header-field-id', 'Custom Header', 'ls_post_custom_header_callback', 'lightsaber_theme_options_page', 'ls-theme-option-section-id');
    add_settings_field('ls-custom-background-field-id', 'Custom Background', 'ls_post_custom_background_callback', 'lightsaber_theme_options_page', 'ls-theme-option-section-id');
 }


 //Post formats callback function
   function ls_theme_options_section_callback(){
     echo "Activate and Deactivate Theme Options here";
 }
 function ls_post_formats_field_callback(){
     $options = get_option('post_formats');
     $formats = array('aside', 'gallery', 'links', 'image', 'quote', 'status', 'video', 'audio', 'chat');
     $output = '';
     foreach($formats as $format){
         $checked = (@$options[$format] == 1 ? 'checked' : '');
         $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.'>'.$format.'</label></br>';    
     }
     echo $output;
 }

 function ls_post_custom_header_callback(){
   $options = get_option('custom_background');
   $checked = (@$options == 1 ? 'checked' : '');
   echo'<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.'>Activate Custom Background</label></br>';    
 }

 function ls_post_custom_background_callback(){
   $options = get_option('custom_header');
   $checked = (@$options == 1 ? 'checked' : '');
   echo'<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.'>Activate Custom Header</label>';    
  
 }

 //Sidebar Options Functions
 function lightsaber_profile_picture_callback(){
    $picture = esc_attr(get_option('profile_picture'));
    if(empty($picture)){
      echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"> 
      <input type="hidden" id="proifle-picture" name="profile_picture" value=""> ';
    }else{
      echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"> 
      <input type="hidden" id="proifle-picture" name="profile_picture" value="'.$picture.'"> 
      <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
    }  
}

 function lightsaber_sidebar_field_callback(){
     $firstName = esc_attr(get_option('first_name'));
     $lastName = esc_attr(get_option('last_name'));
     echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name">
     <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name">';
 }

 function lightsaber_sidebar_description_callback(){
    $description = esc_attr(get_option('user_description'));
    echo '<textarea name="user_description" value="'.$description.'" placeholder="Short Description">'.$description.'</textarea>
    <p class="description">write somthing smart</p>';
 }

 function lightsaber_sidebar_twitter_callback(){
    $twitter = esc_attr(get_option('twitter_handler'));
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler">
    <p class="description">Input Twitter username without the @ character</p>';
 }

 function lightsaber_sidebar_facebook_callback(){
    $facebook = esc_attr(get_option('facebook_handler'));
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler">';
 }

 function lightsaber_sidebar_github_callback(){
    $github = esc_attr(get_option('github_handler'));
    echo '<input type="text" name="github_handler" value="'.$github.'" placeholder="Github Handler">';
 }


 //Twitter Sanitization Settings
 function lightsaber_sanitize_twitter( $input ){
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
 }

 //Template submenu functions
 function lightsaber_sidebar_option_callback(){
     echo 'Edit Sidebar';
 }

 function lightsaber_theme_create_page(){
     require_once(get_template_directory(). '/inc/templates/lightsaber-admin.php');   
 }

 function lightsaber_theme_options_page(){
    require_once(get_template_directory(). '/inc/templates/lightsaber-theme-options.php');
 }

 function lightsaber_theme_settings_page(){
     
 }