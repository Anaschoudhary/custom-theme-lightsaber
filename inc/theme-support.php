<?php

/**
 * @package LightSaberTheme
 * =======================
 * THEME SUPPORT OPTIONS
 * =======================
 * 
 */

$options = get_option( 'post_formats' );
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output = array();
foreach ( $formats as $format ){
	$output[] = ( @$options[$format] == 1 ? $format : '' );
}
if( !empty( $options ) ){
	add_theme_support( 'post-formats', $output );
}

$header = get_option( 'custom_header' );
if( @$header == 1 ){
	add_theme_support( 'custom-header' );
}

$background = get_option( 'custom_background' );
if( @$background == 1 ){
	add_theme_support( 'custom-background' );
}

add_theme_support('post-thumbnails', array('post'));

/* Activate  Nav Menu options */
function ls_register_nav_menu(){
	register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'ls_register_nav_menu');


/* Blog loop custom function */

function ls_posted_meta(){

	$categories = get_the_category();
	$separator = ', ';
	$output = '';
	$i = 1;

	if(!empty($categories) ):

		foreach( $categories as $category):

			if( $i > 1 ): $output .= $separator; endif;

			$output .= '<a href="'. esc_url( get_category_link( $category->term_id ) ) .'" alt="' .esc_attr('View all posts in%s, $category->name').'">'. esc_html($category->name). '</a>';
		$i++; 
		
		endforeach;
	endif;
	
	$posted_on = human_time_diff(get_the_time('U'), current_time('timestamp'));

	return '<span class="posted-on"> Posted <a href="'. esc_url( get_permalink() ) .'">'. $posted_on .'</a> ago</span>/ <span class="posted-in">'.$output.'</span>';
}

function ls_posted_footer(){

	$comments_num = get_comments_number();

	if( comments_open() ){
		
		if( $comments_num == 0 ){
			$comments = __('No Comments');
		}elseif( $comments_num > 1){
			$comments = $comments_num. __(' Commnets');
		}else{
			$comments = __('1 Comments');
		}
		$comments = '<a href="'.get_comments_link().'">'.$comments.'</a>';
	}else{
		$comments = __('Comments are closed');
	}

	return '<div class="post-footer-container"><div class="row">
	<div class="col-md-6 col-sm-6">'. get_the_tag_list('<div class="tags-list">', ' '  ,'</div>') .'</div>
	<div class="col-md-6 col-sm-6 text-right">'. $comments .'</div>
	</div></div>';
}
