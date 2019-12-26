<?php

/**
 * @package LightSaberTheme
 *-- Audio Post Format --
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header text-center"> 

        <?php the_title('<h1 class="entry-title"><a href="'.esc_url( get_permalink()).'" rel="bookmark">', '</a></h1>') ?>

        <div class="entry-meta">
            <?php echo ls_posted_meta(); ?> <!-- this function is in theme-support.php file -->
        </div>

    </header>

    <div class="enrty-content">

        <?php 
            $content = do_shortcode(apply_filters('the_content', $post->post_content ));
            $embed = get_media_embedded_in_content($content, array('audio', 'iframe'));

            echo $embed[0];
        ?>

    </div><!--.entry-content-->

    <footer class="entry-footer">
    <?php echo ls_posted_footer(); ?> 
    </footer>

</article> 
