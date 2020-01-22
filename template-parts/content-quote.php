<?php

/**
 * @package LightSaberTheme
 *-- Quote Post Format --
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ls-format-quote'); ?>>

    <header class="entry-header text-center">
    <div class="row">
        <div class="col-md-8 col-sm-10 mx-auto">
            <h1 class="qoute-content"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_content(); ?></a></h1> 
            <?php the_title('<h2 class="quote-author">- ', ' -</h1>'); ?>
        </div><!--.col-md-8 -->
    </div><!--.row -->
        
    </header>

    <footer class="entry-footer">
    <?php echo ls_posted_footer(); ?> 
    </footer>

</article> 
