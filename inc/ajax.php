<?php

/**
 * @package LightSaberTheme
 * =======================
 * AJAX FUNCTIONS
 * =======================
 * 
 */
add_action('wp_ajax_nopriv_ls_load_more', 'ls_load_more');
add_action('wp_ajax_ls_load_more', 'ls_load_more');

 function ls_load_more(){
     
    $paged = $_POST["page"]+1;
    $prev = $_POST["prev"];
    $archive = $_POST["archive"];

    if($prev == 1 && $_POST["page"] != 1){
        $paged =$_POST["page"]-1;
    }

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $paged,
        'category' => 'updates'
    );

    if($archive != '0'){      
        $archVal = explode('/', $archive);
        $flipped = array_flip($archVal);

        if(isset($flipped["category"]) || $flipped["tag"] || $flipped["author"]){

            if(isset($flipped["category"])){

                $type = "category_name";
                $key = "category"; 

            }elseif(isset($flipped["tag"])){

                $type = "tag";
                $key = $type;

            }elseif(isset($flipped["author"])){
                
                $type = "author";
                $key = $type;

            }
        }
        $current_key = array_keys($archVal, $key);
        $next_key = $current_key[0]+1;
        $value = $archVal[$next_key];

        $args[$type]= $value;

        // if(in_array("category", $archVal)){

        //     $type = "category_name";
        //     $current_key = array_keys($archVal, "category");
        //     $next_key = $current_key[0]+1;
        //     $value = $archVal[$next_key];
        //     $args[$type]= $value;                  
        // }

        // if(in_array("tag", $archVal)){

        //     $type = "tag";
        //     $current_key = array_keys($archVal, "tag");
        //     $next_key = $current_key[0]+1;
        //     $value = $archVal[$next_key];
        //     $args[$type]= $value;                  
        // }

        // if(in_array("author", $archVal)){

        //     $type = "author";
        //     $current_key = array_keys($archVal, "author");
        //     $next_key = $current_key[0]+1;
        //     $value = $archVal[$next_key];
        //     $args[$type]= $value;                  
        // }

        //check page trail and remove "page" value
        if(isset($flipped["page"])){
            $pageVal = explode("page", $archive);
            $page_trail = $pageVal[0];
        }else{
            $page_trail = $archive;
        }     

    }else{
        $page_trail = '/';
    }

    $query = new WP_Query($args);

    if( $query->have_posts() ):
        echo '<div class="page-limit" data-page="'.$page_trail.'page/'.$paged.'/">';
            while( $query->have_posts() ): $query->the_post();

                get_template_part('template-parts/content', get_post_format() );

            endwhile; 
        echo '</div>';
        else: 0;
    endif;
    wp_reset_postdata();

    die();
 }

 function ls_check_paged($num = null){
     $output = '';
     if(is_paged() ){ 
         $output = '/custom-theme/page/'.get_query_var('paged');    
     }
     if($num == 1){
         $paged = (get_query_var('paged') == 0 ? 1 : get_query_var('paged'));
         return $paged;
         
      } else{
          return $output;
      }
}

 