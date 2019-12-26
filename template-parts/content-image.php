<?php

/**
 * @package LightSaberTheme
 *-- Image Post Format --
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ls-format-image'); ?>>

        <?php 
        
            $featured_image = '';

            if(has_post_thumbnail()):   
                $featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ) );  
            else:
                $attachments = get_posts( array(
                    'post_type' => 'attachment',
                    'posts_per_page' => 1,
                    'post_parent' => get_the_ID()
                ) );
                if( $attachments ):
                    foreach( $attachments as $attachment):
                        $featured_image = wp_get_attachment_url( $attachment->ID );
                    endforeach;
                endif;
                wp_reset_postdata();
            endif;
        ?>
        
    <header class="entry-header text-center background-image" style="background-image: url(<?php echo $featured_image; ?>);"> 

        <?php the_title('<h1 class="entry-title"><a href="'.esc_url( get_permalink()).'" rel="bookmark">', '</a></h1>') ?>

        <div class="entry-meta">
            <?php echo ls_posted_meta(); ?> <!-- this function is in theme-support.php file -->
        </div>

        <div class="entry-excerpt image-caption">
            <?php the_excerpt(); ?>
        </div>

    </header>
 
    <!-- <div class="enrty-content">

        <a class="standard-featured-link" href="<?php the_permalink(); ?>">
            <div class="standard-featured"></div>
        </a>                    

    </div>.entry-content -->

    <footer class="entry-footer">
    <?php echo ls_posted_footer(); ?> 
    </footer>

</article> 
