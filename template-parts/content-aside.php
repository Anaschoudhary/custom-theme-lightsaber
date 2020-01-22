<?php

/**
 * @package LightSaberTheme
 *-- Aside Post Format --
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ls-format-aside'); ?>>
    <div class="aside-container">
        <div class="row">
            <div class="col-12 col-sm-3 col-md-2 text-center">
                <?php if(ls_get_attachment()):?>
                    <a class="standard-featured-link" href="<?php the_permalink(); ?>">
                    <div class="aside-featured background-image" style="background-image: url(<?php echo ls_get_attachment(); ?>);"></div>
                    </a>             
                <?php endif; ?>
            </div><!--.col-md-2 -->
            <div class="col-12 col-sm-9 col-md-10">
            <header class="entry-header"> 
                <div class="entry-meta">
                    <?php echo ls_posted_meta(); ?> <!-- this function is in theme-support.php file -->
                </div>
            </header>

            <div class="enrty-content">
                <div class="entry-excerpt">
                    <?php the_content(); ?>
                </div>
            </div><!--.entry-content-->
            </div><!--.col-md-10 -->
        </div><!--.row-->

        <footer class="entry-footer">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <?php echo ls_posted_footer(); ?> 
                </div><!--.col-md-10 -->
            </div><!--.row-->
        </footer>

    </div><!--.aside-container -->
</article> 
