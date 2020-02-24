<?php

/**
 * @package LightSaberTheme
 *-- Single Post Template --
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header text-center"> 
       
        <?php the_title('<h1 class="entry-title">', '</h1>') ?>

        <div class="entry-meta">
            <?php echo ls_posted_meta(); ?> <!-- this function is in theme-support.php file -->
        </div>

    </header>

    <div class="enrty-content clearfix">
        <?php the_content(); ?>
    </div><!--.entry-content-->

    <div class="ls-share-this">
        <h4>Share This</h4>
        <?php echo ls_share_this(); ?>       
    </div><!--.ls-share-->

    <footer class="entry-footer">
    <?php echo ls_posted_footer(); ?> 
    </footer>

</article> 
