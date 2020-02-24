<?php

/**
 * @package LightSaberTheme
 * =======================
 * THEME SUPPORT OPTIONS
 * =======================
 * 
 */

$options = get_option('post_formats');
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$output = array();
foreach ($formats as $format) {
	$output[] = (@$options[$format] == 1 ? $format : '');
}
if (!empty($options)) {
	add_theme_support('post-formats', $output);
}

$header = get_option('custom_header');
if (@$header == 1) {
	add_theme_support('custom-header');
}

$background = get_option('custom_background');
if (@$background == 1) {
	add_theme_support('custom-background');
}

add_theme_support('post-thumbnails', array('post'));

/* Activate  Nav Menu options */
function ls_register_nav_menu()
{
	register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'ls_register_nav_menu');

/*Activate HTML5 Features */
add_theme_support('html5', array('comment-lists', 'comment-form', 'search-form', 'gallery', 'caption'));

/*Sidebar Functions */

function ls_sidebar_init()
{
	register_sidebar(
		array(
			'name' => esc_html('LightSaber Sidebar', 'LightSaberTheme'),
			'id' => 'lightsaber-sidebar',
			'description' => 'Dynamic Right Sidebar',
			'before_widget' => '<section id="%1$s" class="lightsaber-widget %2$s">',
			'after-widget' => '</section>',
			'before_title' => '<h2 class="ls-widget-title">',
			'after_title' => '</h2>',

		)
	);
}
add_action('widgets_init', 'ls_sidebar_init');

/* Blog loop custom function */

function ls_posted_meta()
{

	$categories = get_the_category();
	$separator = ', ';
	$output = '';
	$i = 1;

	if (!empty($categories)) :

		foreach ($categories as $category) :

			if ($i > 1) : $output .= $separator;
			endif;

			$output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr('View all posts in%s, $category->name') . '">' . esc_html($category->name) . '</a>';
			$i++;

		endforeach;
	endif;

	$posted_on = human_time_diff(get_the_time('U'), current_time('timestamp'));

	return '<span class="posted-on"> Posted <a href="' . esc_url(get_permalink()) . '">' . $posted_on . '</a> ago</span>/ <span class="posted-in">' . $output . '</span>';
}

function ls_posted_footer()
{

	$comments_num = get_comments_number();

	if (comments_open()) {

		if ($comments_num == 0) {
			$comments = __('No Comments');
		} elseif ($comments_num > 1) {
			$comments = $comments_num . __(' Commnets');
		} else {
			$comments = __('1 Comments');
		}
		$comments = '<a href="' . get_comments_link() . '">' . $comments . '</a>';
	} else {
		$comments = __('Comments are closed');
	}

	return '<div class="post-footer-container"><div class="row">
	<div class="col-md-6 col-sm-6">' . get_the_tag_list('<div class="tags-list">', ' ', '</div>') . '</div>
	<div class="col-md-6 col-sm-6 text-right">' . $comments . '</div>
	</div></div>';
}

function ls_get_attachment($num = 1)
{

	$output = '';
	if (has_post_thumbnail() && $num == 1) :
		$output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
	else :
		$attachments = get_posts(array(
			'post_type' => 'attachment',
			'post_per_page' => $num,
			'post_parent' => get_the_ID()
		));
		if ($attachments && $num == 1) :
			foreach ($attachments as $attachment) :
				$output = wp_get_attachment_url($attachment->ID);
			endforeach;
		elseif ($attachments && $num > 1) :
			$output = $attachments;
		endif;
		wp_reset_postdata();
	endif;
	return $output;
}

function ls_get_embedded_media($type = array())
{

	$content = do_shortcode(apply_filters('the_content', get_the_content()));
	$embed = get_media_embedded_in_content($content, $type);

	if (in_array('audio', $type)) :
		$output = str_replace('?visual=true', '?visual=false', $embed[0]);
	else :
		$output = $embed[0];
	endif;
	return $output;
}

function ls_get_bs_slides($attachments)
{

	$output = array();
	$count = count($attachments) - 1;
	for ($i = 0; $i <= $count; $i++) :

		$active = ($i == 0 ? ' active' : '');

		$n = ($i == $count ? 0 : $i + 1);
		$nextImg = wp_get_attachment_thumb_url($attachments[$n]->ID);
		$p = ($i == 0 ? $count : $i - 1);
		$prevImg = wp_get_attachment_thumb_url($attachments[$p]->ID);

		$output[$i] = array(
			'class'    => $active,
			'url' 	   => wp_get_attachment_url($attachments[$i]->ID),
			'next_img' => $nextImg,
			'prev_img' => $prevImg,
			'caption'  => $attachments[$i]->post_excerpt
		);

	endfor;
	return $output;
}

function ls_grab_url()
{
	if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $link)) {
		return false;
	}
	return esc_url_raw($link[1]);
}

function ls_grab_current_uri()
{

	$http = (isset($_SERVER["HTTPS"]) ? 'htts://' : 'http://');
	$referer = $http . $_SERVER["HTTP_HOST"];
	$archive_url = $referer . $_SERVER["REQUEST_URI"];

	return $archive_url;
}

/* Single Post Custom Funstions */
function ls_post_navigation()
{

	$nav = '<div class="row">';

	$prev = get_previous_post_link('<div class="post-link-nav">« %link</div>', '%title');
	$nav .= '<div class="col-md-6 col-sm-6">' . $prev . '</div>';

	$next = get_next_post_link('<div class="post-link-nav">%link »</div>', '%title');
	$nav .= '<div class="col-md-6 col-sm-6 text-right">' . $next . '</div>';
	$nav .= '</div>';
	return $nav;
}

/* Social Media Share Icons Function*/
function ls_share_this()
{

	$title = get_the_title();
	$permalink = get_permalink();

	$twitterHandler = (get_option('twitter_handler') ? '&amp;via=' . esc_attr(get_option('twitter_handler')) : '');

	$twitter = 'https://twitter.com/intent/tweet?text=Hey! Read this: ' . $title . '&amp;url=' . $permalink . $twitterHandler . '';

	$facebook = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;

	$google = 'https://plus.google.com/share?url=' . $permalink;

	$output = '';
	$output .= '<ul>';
	$output .= '<li><a href="' . $twitter . ' ?>" target="_blank" rel="nofollow"><span class="dashicons dashicons-twitter"></span></a></li>';
	$output .= '<li><a href="' . $facebook . ' ?>" target="_blank" rel="nofollow"><span class="dashicons dashicons-facebook"></span></a></li>';
	$output .= '<li><a href="' . $google . ' ?>" target="_blank" rel="nofollow"><span class="dashicons dashicons-googleplus"></span></a></li>';
	$output .= '</ul>';

	return $output;
}

function ls_comment_navigation()
{
	if (get_comment_pages_count() > 1 && get_option('page_comments')) :
		require_once(get_template_directory() . '/inc/templates/ls-comment-nav.php');
	endif;
}
