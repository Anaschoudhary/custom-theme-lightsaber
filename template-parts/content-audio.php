<?php

/**
 * @package LightSaberTheme
 *-- Audio Post Format --
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ls-format-audio'); ?>>

    <header class="entry-header"> 

        <?php the_title('<h1 class="entry-title"><a href="'.esc_url( get_permalink()).'" rel="bookmark">', '</a></h1>') ?>

        <div class="entry-meta">
            <?php echo ls_posted_meta(); ?> <!-- this function is in theme-support.php file -->
        </div>

    </header>

    <div class="enrty-content">

        <?php 
            echo ls_get_embedded_media(array('audio', 'iframe'));
        ?>

    </div><!--.entry-content-->

    <footer class="entry-footer">
    <?php echo ls_posted_footer(); ?> 
    </footer>

</article> 
