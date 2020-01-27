jQuery(document).ready(function($){
    //custom ls js

    /*init fucntion*/
    revealPosts();  

    /*variables decalarations */
     
    var carousel = '.ls-carousel-thumb';
    var last_scroll = 0;

    /*carousel function*/
    ls_get_bs_thumbs( carousel );

    $(carousel).on('slid.bs.carousel', function(){
        ls_get_bs_thumbs( carousel );
    });

    function ls_get_bs_thumbs( carousel ){
        var nextThumb = $('.carousel-item.active').find('.next-image-preview').data('image');
        var prevThumb = $('.carousel-item.active').find('.prev-image-preview').data('image');
        $(carousel).find('.ctrljs.right').find('.thumbnail-container').css({'background-image': 'url('+nextThumb+')'});
        $(carousel).find('.ctrljs.left').find('.thumbnail-container').css({'background-image': 'url('+prevThumb+')'});
    }

    /* Ajax Functions for infinite load */
    $(document).on('click', '.ls-load-more:not(.loading)', function(){

        var that = $(this);
        var page = $(this).data('page');
        var newPage = page+1;
        var ajaxurl = that.data('url');
        var prev = that.data('prev');

        if(typeof prev == 'undefined'){
            prev = 0;
        }

        that.addClass("loading").find('.text').slideUp(320);
        that.find('.sunset-icon').addClass("spin");

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data:{ 
                page: page,  
                prev: prev,
                action: 'ls_load_more' //php function
            },
            error: function(respone){
                console.log(response);
            },
            success: function(response){
                 
                if(response == 0 ){

                    $('.ls-posts-container').append('<center><h3>You reached end of the line!</h3><p>No more post to load</p></center>');
                    that.slideUp(320);

                }else{

                    setTimeout(function(){

                        if(prev == 1 ){  
                            $('.ls-posts-container').prepend(response);
                            newPage = page-1;
                        }else{
                            $('.ls-posts-container').append(response);
                        }
                        
                        if(newPage == 1){
                            that.slideUp(320);
                        }else{

                            that.data('page', newPage);
                            that.removeClass("loading").find('.text').slideDown(320);
                            that.find('.sunset-icon').removeClass("spin");
                        }
                        
                        revealPosts();
                    }, 1000);

                }
                

                
            }
        });
        
    });

    /* Scroll funtion*/ 
    $(window).scroll(function(){

        var scroll = $(window).scrollTop(); 
        if(Math.abs(scroll - last_scroll) > $(window).height()*0.1){
            last_scroll = scroll;
            $('.page-limit').each(function(index){

                if(isVisible( $(this) )){
                    history.replaceState(null, null, $(this).attr("data-page"));
                    return(false);
                }

            });
        }
       
    });

    /*helper function*/
    function revealPosts(){

        var posts = $('article:not(.reveal)');
        var i = 0;

        setInterval(function(){ 

            if(i >= posts.lenght) return false;
                var el = posts[i];
                $(el).addClass('reveal').find('.ls-carousel-thumb').carousel;
            i++

        }, 200);
    }

    function isVisible(element){
        var scroll_pos = $(window).scrollTop(); //give the scroll length in px of window
        var window_height = $(window).height(); //give the complete height of windoe
        var el_top = $(element).offset().top; //give the cordinate of the element form top
        var el_height = $(element).height(); //give the element height
        var el_bottom = el_top + el_height;
        return ((el_bottom - el_height*0.25 > scroll_pos) && (el_top < (scroll_pos+0.5*window_height)));
    }
 }); 