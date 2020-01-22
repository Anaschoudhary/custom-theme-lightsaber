<?php

/**
 * @package LightSaberTheme
 *-- Gallery Post Format --
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ls-format-gallery'); ?>>

    <header class="entry-header text-center"> 

    <?php if(ls_get_attachment()):  
        $attachments = ls_get_attachment(7);
        
     ?> 
     <div id="post-gallery-<?php the_ID(); ?>" class="carousel slide ls-carousel-thumb" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php 
                $attachments = ls_get_bs_slides(ls_get_attachment(7));
                foreach($attachments as $attachment):
                    ?>

                <div class="carousel-item<?php echo $attachment['class'] ?> background-image standard-featured" style="background-image: url(<?php echo $attachment['url']; ?>);">
                    <div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div>
                    <div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div>
                </div>
                <div class="entry-excerpt image-caption">
                    <p><?php echo $attachment['caption']; ?></p>
                </div>
                

                <?php endforeach;  ?>
        </div><!--.carousel-inner-->
        <a class="left carousel-control-prev ctrljs" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
            <div class="preview-container">
                <span class="thumbnail-container background-image"></span>
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
             </div><!--.preview-container -->
        </a>
        <a class="right carousel-control-next ctrljs" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
            <div class="preview-container">
                <span class="thumbnail-container background-image"></span>
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span> 
            </div><!--.preview-container -->
        </a>
     </div><!--.carousel -->
            
    <?php endif; ?>

        <?php the_title('<h1 class="entry-title"><a href="'.esc_url( get_permalink()).'" rel="bookmark">', '</a></h1>') ?>

        <div class="entry-meta">
            <?php echo ls_posted_meta(); ?> <!-- this function is in theme-support.php file -->
        </div>

    </header>

    <div class="enrty-content">

        

        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>
        
        <div class="button-container text-center">
            <a href="<?php the_permalink(); ?>" class="btn btn-ls"><?php _e('Read More'); ?></a>
        </div>

    </div><!--.entry-content-->

    <footer class="entry-footer">
    <?php echo ls_posted_footer(); ?> 
    </footer>

</article> 
