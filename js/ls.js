jQuery(document).ready(function($){
    //custom ls js

    var carousel = '.ls-carousel-thumb';
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

        that.addClass("loading").find('.text').slideUp(320);
        that.find('.sunset-icon').addClass("spin");

        $.ajax({
            url: ajaxurl,
            type: 'post',
            data:{ 
                page: page,  
                action: 'ls_load_more' //php function
            },
            error: function(respone){
                console.log(response);
            },
            success: function(response){
                that.data('page', newPage);
                $('.ls-posts-container').append(response);

                setTimeout(function(){
                    that.removeClass("loading").find('.text').slideDown(320);
                    that.find('.sunset-icon').removeClass("spin");
                }, 1000);

                
            }
        });
        
    });
 });