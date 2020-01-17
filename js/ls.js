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

 });