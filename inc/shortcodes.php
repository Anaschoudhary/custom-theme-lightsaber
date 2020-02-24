<?php

/*
	
@package LightSaberTheme
	
	========================
		SHORTCODES OPTIONS
	========================
*/
function ls_tooltip($atts, $content = null){

    //get the attributes
    $args = shortcode_atts(
        array(
            'placement' => 'top',
            'title' => '',
        ),
        $atts,
        'tooltip'
    );

    $title = ($args['title'] == '' ? $content : $args['title']);
    //return html
    return '<span class="ls-tooltip" data-toggle="tooltip" data-placement="'.$args['placement'].'" title="'.$title.'">'.$content.'</span>';
}

add_shortcode('tooltip', 'ls_tooltip');


function ls_popover($atts, $content = null){

    //[popover title="Popover title" placement="top" trigger="click" content="This is the popover content"]Click to toggle popover[/popover] 

    //get the attributes
    $args = shortcode_atts(
        array(
            'placement' => 'top',
            'title' => '',
            'trigger' => 'click',
            'content' => '',
        ),
        $atts,
        'popover'
    );

    //return html
    return '<span class="ls-popover" data-toggle="popover" data-placement="'.$args['placement'].'" 
    title="'.$args['title'].'" data-trigger="'.$args['trigger'].'" data-content="'.$args['content'].'">'.$content.'</span>';
}
add_shortcode('popover', 'ls_popover');