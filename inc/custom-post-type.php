<?php

/**
 * @package LightSaberTheme
 * =======================
 * THEME CUSTOM POST TYPE
 * =======================
 * 
 */

$contact = get_option( 'activate_contact' );

if( @$contact == 1 ){
    add_action('init', 'ls_contact_custom_post_type');

    add_filter('manage_lightsaber-contact_posts_columns', 'ls_lightsaber_contact_columns');
    add_action('manage_lightsaber-contact_posts_custom_column', 'ls_contact_custom_column', 10, 2);

    add_action('add_meta_boxes', 'ls_contact_add_meta_box');
    add_action('save_post', 'ls_save_contact_emial_data');
}

/* Contact CPT */

function ls_contact_custom_post_type(){

    $lables = array(
        'name' => 'Message',
        'singular_name' => 'Message',
        'menu_name' => 'Messages',
        'name_admin_bar' => 'Message'
    );

    $args = array(
        'labels' => $lables,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 26,
        'menu_icon' => 'dashicons-email-alt',
        'supports' => array('title', 'editor', 'author')
    );
    register_post_type('lightsaber-contact', $args);
}
function ls_lightsaber_contact_columns($newColumns){

    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';

    return $newColumns;
}

function ls_contact_custom_column($column, $post_id){
    
    switch($column){

        case 'message':
            echo get_the_excerpt();
        break;

        case 'email':
            $email = get_post_meta($post_id, '_contact_email_value_key', true);
            echo '<a href="mailto:'.$email.'">'.$email.'</a>';
        break;
    }
}

/* CONTACT META BOXES*/

function ls_contact_add_meta_box(){
    add_meta_box('contact_email', 'User Email', 'ls_contact_email_cb', 'lightsaber-contact', 'side', 'high');
}

function ls_contact_email_cb( $post ){
    wp_nonce_field('ls_save_contact_emial_data', 'ls_contact_email_meta_box_nonce');

    $value = get_post_meta($post->ID, '_contact_email_value_key', true);

    echo '<label for="ls_contact_email_field">User Email Address: </label>';
    echo '<input type="email" id="ls_contact_email_field" name="ls_contact_email_field" value="'.esc_attr($value).'" size="25"/>';
}

function ls_save_contact_emial_data($post_id){

    if(!isset($_POST['ls_contact_email_meta_box_nonce'])){
        return;
    }
    if(!wp_verify_nonce($_POST['ls_contact_email_meta_box_nonce'], 'ls_save_contact_emial_data')){
        return;
    }
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }
    if(!current_user_can('edit_post', $post_id)){
        return;
    }
    if(!isset($_POST['ls_contact_email_field'])){
        return;
    }

    $my_data = sanitize_text_field($_POST['ls_contact_email_field']);
    update_post_meta($post_id, '_contact_email_value_key', $my_data);
}